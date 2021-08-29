<?php

declare(strict_types=1);

namespace App\Tests\Unit\Bet\Application;

use App\Bet\Application\Create\CreateBetCommand;
use App\Bet\Application\Create\CreateBetCommandHandler;
use App\Bet\Domain\Event\BetCreated;
use App\Bet\Domain\Repository\BetRepositoryInterface;
use App\Bet\Domain\Resource\Bet;
use App\Bet\Domain\Validation\CreateBetValidatorInterface;
use App\Shared\ValueObject\ErrorBag;
use App\Shared\ValueObject\ValidationResult;
use App\Tests\BaseTestCase;
use Symfony\Component\Uid\UuidV4;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

final class CreateBetTest extends BaseTestCase
{
    /**
     * @test
     * @dataProvider betDataProvider
     */
    public function thatCreatesBet($title, $startDate, $endDate)
    {
        $expectedBet = new Bet();

        $betId = (string) new UuidV4();
        $userId = (string) new UuidV4();

        $expectedBet->setId($betId);
        $expectedBet->setTitle($title);
        $expectedBet->setStartDate($startDate);
        $expectedBet->setEndDate($endDate);

        $betRepository = $this->createMock(BetRepositoryInterface::class);

        $betRepository
            ->expects($this->once())
            ->method('add')
            ->with($expectedBet);

        $expectedBetCreated = new BetCreated($betId);

        $eventDispatcher = $this->createMock(EventDispatcherInterface::class);

        $eventDispatcher
            ->expects($this->once())
            ->method('dispatch')
            ->with($expectedBetCreated);

        $createBetValidator = $this->createMock(CreateBetValidatorInterface::class);

        $createBetValidator
            ->expects($this->once())
            ->method('validate')
            ->willReturn(new ValidationResult(new ErrorBag()));

        $createBetHandler = new CreateBetCommandHandler(
            $betRepository,
            $eventDispatcher,
            $createBetValidator,
        );

        ($createBetHandler)(new CreateBetCommand(
            $betId,
            $userId,
            $title,
            $startDate,
            $endDate,
        ));
    }

    public function betDataProvider(): array
    {
        return [
            ['Test bet', '2021-07-01', '2021-09-01'],
            ['Test challenge', '2021-07-01', null],
        ];
    }
}
