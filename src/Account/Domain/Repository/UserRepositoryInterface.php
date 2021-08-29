<?php

declare(strict_types=1);

namespace App\Account\Domain\Repository;

use App\Account\Domain\Resource\User;

/**
 * @method \App\Account\Domain\Resource\User|null find($id, $lockMode = null, $lockVersion = null)
 * @method \App\Account\Domain\Resource\User|null findOneBy(array $criteria, array $orderBy = null)
 * @method \App\Account\Domain\Resource\User[]    findAll()
 * @method \App\Account\Domain\Resource\User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
interface UserRepositoryInterface
{
    public function existByEmail(string $email): bool;

    public function add(User $user): void;
}
