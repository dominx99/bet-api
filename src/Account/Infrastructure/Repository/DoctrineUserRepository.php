<?php

namespace App\Account\Infrastructure\Repository;

use App\Account\Domain\Repository\UserRepositoryInterface;
use App\Account\Domain\Resource\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @method \App\Account\Domain\Resource\User|null find($id, $lockMode = null, $lockVersion = null)
 * @method \App\Account\Domain\Resource\User|null findOneBy(array $criteria, array $orderBy = null)
 * @method \App\Account\Domain\Resource\User[]    findAll()
 * @method \App\Account\Domain\Resource\User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctrineUserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface, UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    public function existByEmail(string $email): bool
    {
        return (bool) $this
            ->getEntityManager()
            ->createQueryBuilder()
            ->select('COUNT(u.id) as exist')
            ->from(User::class, 'u')
            ->where('u.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
