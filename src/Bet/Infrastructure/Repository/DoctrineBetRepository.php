<?php

declare(strict_types=1);

namespace App\Bet\Infrastructure\Repository;

use App\Bet\Domain\Repository\BetRepositoryInterface;
use App\Bet\Domain\Resource\Bet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

final class DoctrineBetRepository extends ServiceEntityRepository implements BetRepositoryInterface
{
    public function add(Bet $bet): void
    {
        $entityManager = $this->getEntityManager();

        $entityManager->persist($bet);
        $entityManager->flush();
    }
}
