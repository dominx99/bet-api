<?php

declare(strict_types=1);

namespace App\Bet\Domain\Repository;

use App\Bet\Domain\Resource\Bet;

/**
 * @method \App\Bet\Domain\Resource\Bet|null find($id, $lockMode = null, $lockVersion = null)
 * @method \App\Bet\Domain\Resource\Bet|null findOneBy(array $criteria, array $orderBy = null)
 * @method \App\Bet\Domain\Resource\Bet[]    findAll()
 * @method \App\Bet\Domain\Resource\Bet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
interface BetRepositoryInterface
{
    public function add(Bet $bet): void;
}
