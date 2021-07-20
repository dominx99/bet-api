<?php

declare(strict_types=1);

namespace App\Bet\Application\Create;

final class CreateBetCommand
{
    public function __construct(
        public string $title,
    ) {
    }
}
