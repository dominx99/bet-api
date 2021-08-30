<?php

declare(strict_types=1);

namespace App\Bet\Domain\Resource;

use App\Account\Domain\Resource\User;
use App\Bet\Domain\Repository\BetRepositoryInterface;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;

#[Entity(repositoryClass: BetRepositoryInterface::class, readOnly: false)]
final class Bet
{
    #[Id, Column(type: 'uuid')]
    private string $id;

    #[Column(type: 'string', length: 255)]
    private string $title;

    #[ManyToMany(targetEntity: User::class, mappedBy: 'bets')]
    private Collection $members;

    #[Column(type: 'datetime')]
    private DateTimeInterface $startDate;

    #[Column(type: 'datetime', nullable: true)]
    private ?DateTimeInterface $endDate;

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setMembers(ArrayCollection $members): void
    {
        $this->members = $members;
    }

    public function getMembers(): ArrayCollection
    {
        return $this->members;
    }

    public function setStartDate(DateTimeInterface $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getStartDate(): DateTimeInterface
    {
        return $this->startDate;
    }

    public function setEndDate(?DateTimeInterface $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getEndDate(): ?DateTimeInterface
    {
        return $this->endDate;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function addMember(User $user): void
    {
        $this->members->add($user);
    }
}
