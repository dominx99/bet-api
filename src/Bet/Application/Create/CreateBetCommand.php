<?php

declare(strict_types=1);

namespace App\Bet\Application\Create;

final class CreateBetCommand
{
    public function __construct(
        private string $betId,
        private string $userId,
        private string $title,
        private string $startDate,
        private ?string $endDate,
    ) {
    }

    public function setBetId(string $betId): void
    {
        $this->betId = $betId;
    }

    public function getBetId(): string
    {
        return $this->betId;
    }

    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setStartDate(string $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getStartDate(): string
    {
        return $this->startDate;
    }

    public function setEndDate(?string $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getEndDate(): ?string
    {
        return $this->endDate;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ];
    }
}
