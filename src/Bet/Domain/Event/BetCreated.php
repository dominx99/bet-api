<?php

declare(strict_types=1);

namespace App\Bet\Domain\Event;

final class BetCreated
{
    public const NAME = 'bet.created';

    public function __construct(
        public string $betId,
    ) {
    }
}
