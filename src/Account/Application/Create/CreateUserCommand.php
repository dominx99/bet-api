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

    public function setUserId(string $userId)
    {
        $this->userId = $userId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
