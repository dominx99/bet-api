<?php

declare(strict_types=1);

namespace App\Shared\Domain\Exception;

use Exception;

final class ValidationException extends Exception
{
    private function __construct(
        private array $messages
    ) {
        parent::__construct('', 400);
    }

    public static function withMessages(array $messages): self
    {
        return new static($messages);
    }

    public function getMessages(): array
    {
        return $this->messages;
    }
}
