<?php

declare(strict_types=1);

namespace App\Account\Http\Action;

use App\Account\Domain\Repository\UserRepositoryInterface;

final class LoginAction
{
    public function __construct (
        private UserRepositoryInterface $userRepository,
    ) {}

    public function __invoke()
    {
    }
}
