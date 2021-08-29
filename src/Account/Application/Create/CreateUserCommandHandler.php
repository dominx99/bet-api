<?php

declare(strict_types=1);

namespace App\Account\Application\Create;

use App\Account\Domain\Event\UserCreated;
use App\Account\Domain\Repository\UserRepositoryInterface;
use App\Account\Domain\Resource\User;
use App\Account\Domain\Role\UserRoleEnum;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

final class CreateUserCommandHandler implements MessageHandlerInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private UserPasswordHasherInterface $passwordHasher,
        private EventDispatcherInterface $eventDispatcher,
    ) {
    }

    public function __invoke(CreateUserCommand $command): void
    {
        $user = new User();
        $user->setId($command->getUserId());
        $user->setEmail($command->getEmail());
        $user->setPassword($this->passwordHasher->hashPassword($user, $command->getPassword()));
        $user->setName($command->getName());
        $user->setRoles([UserRoleEnum::USER]);

        $this->userRepository->add($user);

        $this->eventDispatcher->dispatch(new UserCreated($command->getUserId()));
    }
}
