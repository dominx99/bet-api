<?php

declare(strict_types=1);

namespace App\Shared\ValueObject;

use Countable;

final class ErrorBag implements Countable
{
    public function __construct(
        private array $items = [],
    ) {
    }

    public function set(string $offset, array $errors): void
    {
        $this->items[$offset] = $errors;
    }

    public function isEmpty(): bool
    {
        foreach ($this->items as $errors) {
            if (!empty($errors)) {
                return false;
            }
        }

        return true;
    }

    public function all(): array
    {
        return $this->items;
    }

    public function count(): int
    {
        return count($this->items);
    }
}
