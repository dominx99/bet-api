<?php

declare(strict_types=1);

namespace App\Bet\Infrastructure\Repository;

use App\Bet\Domain\Repository\BetRepositoryInterface;
use App\Bet\Domain\Resource\Bet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class DoctrineBetRepository extends ServiceEntityRepository implements BetRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bet::class);
    }

    public function add(Bet $bet): void
    {
        $entityManager = $this->getEntityManager();

        $entityManager->persist($bet);
        $entityManager->flush();
    }
}
