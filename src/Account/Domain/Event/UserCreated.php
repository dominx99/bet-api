<?php

declare(strict_types=1);

namespace App\Account\Domain\Event;

use App\Shared\Domain\Event\EventInterface;

final class UserCreated implements EventInterface
{
    public function __construct(
        public string $userId,
    ) {
    }
}
