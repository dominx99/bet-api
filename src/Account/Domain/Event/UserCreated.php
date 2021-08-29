<?php

declare(strict_types=1);

namespace App\Account\Domain\Event;

use App\Shared\Domain\Event\EventInterface;

final class UserCreated implements EventInterface
{
    public const NAME = 'user.created';

    public function __construct(
        public string $userId,
    ) {
    }

    public function getUserId(): string
    {
        return $this->userId;
    }
}
