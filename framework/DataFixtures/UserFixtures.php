<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Account\Domain\Resource\User;
use Symfony\Component\Uid\UuidV4;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setId(new UuidV4());
        $user->setEmail('test@example.com');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'test'));
        $user->setName('Test');

        $manager->persist($user);
        $manager->flush();
    }
}
