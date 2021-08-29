<?php

declare(strict_types=1);

namespace App\Account\Application\Create;

final class CreateUserCommand
{
    public function __construct(
        private string $userId,
        private string $email,
        private string $password,
        private string $name,
    ) {
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
