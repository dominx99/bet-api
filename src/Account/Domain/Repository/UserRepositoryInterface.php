<?php

declare(strict_types=1);

namespace App\Account\Domain\Repository;

interface UserRepositoryInterface
{
    public function existByEmail(string $email): bool;
}
