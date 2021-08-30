<?php

declare(strict_types=1);

namespace App\Bet\Application\Create;

use App\Bet\Domain\Event\BetCreated;
use App\Bet\Domain\Repository\BetRepositoryInterface;
use App\Bet\Domain\Resource\Bet;
use Carbon\Carbon;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

final class CreateBetCommandHandler implements MessageHandlerInterface
{
    public function __construct(
        private BetRepositoryInterface $betRepository,
        private EventDispatcherInterface $eventDispatcher,
    ) {
    }

    public function __invoke(CreateBetCommand $command): void
    {
        $bet = new Bet();
        $bet->setId($command->getBetId());
        $bet->setTitle($command->getTitle());
        $bet->setStartDate(Carbon::createFromFormat('Y-m-d H:i:s', $command->getStartDate()));
        $bet->setEndDate(
            $command->getEndDate() ?
                Carbon::createFromFormat('Y-m-d H:i:s', $command->getEndDate()) :
                null
        );

        $this->betRepository->add($bet);

        $this->eventDispatcher->dispatch(new BetCreated($command->getBetId()));
    }
}
