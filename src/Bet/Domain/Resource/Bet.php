<?php

declare(strict_types=1);

namespace App\Domain;

use Doctrine\Common\Collections\ArrayCollection;

final class Bet
{
    private string $title;

    private ArrayCollection $members;

    public function __construct()
    {
        $this->members = new ArrayCollection();
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
