<?php

declare(strict_types=1);

namespace App\Bet\Domain\Resource;

use Doctrine\Common\Collections\ArrayCollection;

final class Bet
{
    private string $id;

    private string $title;

    private ArrayCollection $members;

    private $startDate;

    private $endDate;

    public function __construct()
    {
        $this->members = new ArrayCollection();
    }

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

    public function setStartDate($startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setEndDate($endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getEndDate()
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

    public function addMember(User $uesr): void
    {
        $this->members->add($user);
    }
}
