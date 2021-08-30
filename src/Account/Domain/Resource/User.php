<?php

namespace App\Account\Domain\Resource;

use App\Account\Infrastructure\Repository\DoctrineUserRepository;
use App\Bet\Domain\Resource\Bet;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\InverseJoinColumn;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[Entity(repositoryClass: DoctrineUserRepository::class, readOnly: false)]
#[UniqueEntity('email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[Id, Column(type: 'uuid')]
    private string $id;

    #[Column(type: 'string', length: 180, unique: true)]
    private string $email;

    #[Column(type: 'json')]
    private array $roles;

    #[Column(type: 'string', length: 255)]
    private $password;

    #[Column(type: 'string', length: 255)]
    private $name;

    #[ManyToMany(targetEntity: Bet::class, inversedBy: 'members')]
    #[JoinTable(name: 'bet_user')]
    #[JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    #[InverseJoinColumn(name: 'bet_id', referencedColumnName: 'id')]
    private Collection $bets;

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getUsername(): string
    {
        return $this->email;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @see \Symfony\Component\Security\Core\User\UserInterface
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @see \Symfony\Component\Security\Core\User\UserInterface
     */
    public function eraseCredentials()
    {
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
