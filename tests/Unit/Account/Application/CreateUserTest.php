<?php

declare(strict_types=1);

namespace App\Tests\Unit\Account\Application;

use App\Account\Application\Create\CreateUserCommand;
use App\Account\Application\Create\CreateUserCommandHandler;
use App\Account\Domain\Event\UserCreated;
use App\Account\Domain\Repository\UserRepositoryInterface;
use App\Account\Domain\Resource\User;
use App\Account\Domain\Role\UserRoleEnum;
use App\Tests\BaseTestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\Uid\UuidV4;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

final class CreateUserTest extends BaseTestCase
{
    /**
     * @test
     * @dataProvider userDataProvider
     */
    public function thatUserIsCreated($email, $password, $name)
    {
        $userId = (string) new UuidV4();
        $hashedPassword = base64_encode($password);

        $expectedUser = new User();
        $expectedUser->setId($userId);
        $expectedUser->setEmail($email);
        $expectedUser->setPassword($hashedPassword);
        $expectedUser->setName($name);
        $expectedUser->setRoles([UserRoleEnum::USER]);

        $userRepository = $this->createMock(UserRepositoryInterface::class);

        $userRepository
            ->expects($this->once())
            ->method('add')
            ->with($expectedUser);

        $passwordHasher = $this->createMock(UserPasswordHasher::class);

        $passwordHasher
            ->expects($this->once())
            ->method('hashPassword')
            ->willReturn($hashedPassword);

        $expectedUserCreated = new UserCreated($userId);

        $eventDispatcher = $this->createMock(EventDispatcherInterface::class);

        $eventDispatcher
            ->expects($this->once())
            ->method('dispatch')
            ->with($expectedUserCreated);

        $createUserHandler = new CreateUserCommandHandler(
            $userRepository,
            $passwordHasher,
            $eventDispatcher,
        );

        ($createUserHandler)(new CreateUserCommand(
            $userId,
            $email,
            $password,
            $name,
        ));
    }

    public function userDataProvider(): array
    {
        return [
            ['example@test.com', 'password', 'Test name'],
            ['example1@test.com', '!p$ssw0rd914', 'Test'],
            ['example2@test.com', 'some-pass', 'Test3'],
        ];
    }
}
