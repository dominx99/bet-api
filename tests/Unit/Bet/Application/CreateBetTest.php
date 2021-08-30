<?php

declare(strict_types=1);

namespace App\Tests\Unit\Bet\Application;

use App\Bet\Application\Create\CreateBetCommand;
use App\Bet\Application\Create\CreateBetCommandHandler;
use App\Bet\Domain\Event\BetCreated;
use App\Bet\Domain\Repository\BetRepositoryInterface;
use App\Bet\Domain\Resource\Bet;
use App\Tests\BaseTestCase;
use Symfony\Component\Uid\UuidV4;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Carbon\Carbon;

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
        $expectedBet->setStartDate(Carbon::createFromFormat('Y-m-d H:i:s', $startDate));
        $expectedBet->setEndDate(
            $endDate ?
                Carbon::createFromFormat('Y-m-d H:i:s', $endDate) :
                null
        );

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

        $createBetHandler = new CreateBetCommandHandler(
            $betRepository,
            $eventDispatcher,
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
            ['Test bet', '2021-07-01 01:01:01', '2021-09-01 01:01:01'],
            ['Test challenge', '2021-07-01 01:01:01', null],
        ];
    }
}
