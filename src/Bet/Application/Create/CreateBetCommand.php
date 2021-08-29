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

    public function getBetId(): string
    {
        return $this->betId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getStartDate(): string
    {
        return $this->startDate;
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
