<?php

declare(strict_types=1);

namespace App\Bet\Application\Create;

use App\Bet\Domain\Event\BetCreated;
use App\Bet\Domain\Repository\BetRepositoryInterface;
use App\Bet\Domain\Resource\Bet;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use App\Bet\Domain\Validation\CreateBetValidatorInterface;

final class CreateBetCommandHandler implements MessageHandlerInterface
{
    public function __construct(
        private BetRepositoryInterface $betRepository,
        private EventDispatcherInterface $eventDispatcher,
        private CreateBetValidatorInterface $createBetValidator,
    ) {
    }

    public function __invoke(CreateBetCommand $command): void
    {
        $this->createBetValidator->validate($command->toArray());

        $bet = new Bet();
        $bet->setId($command->getBetId());
        $bet->setTitle($command->getTitle());
        $bet->setStartDate($command->getStartDate());
        $bet->setEndDate($command->getEndDate());

        $this->betRepository->add($bet);

        $this->eventDispatcher->dispatch(new BetCreated($command->getBetId()));
    }
}
