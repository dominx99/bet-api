<?php

declare(strict_types=1);

namespace App\Tests;

final class UsesDatabaseTrait
{
    public function cleanTestDatabase()
    {
        $entitiesToClean = [
            User::class,
        ];
        $this->entityManager->getConnection()->executeQuery('SET FOREIGN_KEY_CHECKS = 0;');

        foreach ($entitiesToClean as $entityToClean) {
            $this->entityManager->createQuery('delete from '.$entityToClean)->execute();
        }

        $this->entityManager->getConnection()->executeQuery('SET FOREIGN_KEY_CHECKS = 1;');

        $this->entityManager->flush();
        $this->entityManager->clear();
    }
}
