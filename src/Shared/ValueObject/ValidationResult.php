<?php

declare(strict_types=1);

namespace App\Shared\ValueObject;

final class ValidationResult
{
    public function __construct(
        private ErrorBag $errors,
    ) {
    }

    public function setErrors(ErrorBag $errors): void
    {
        $this->errors = $errors;
    }

    public function getErrors(): ErrorBag
    {
        return $this->errors;
    }

    public function isValid(): bool
    {
        return 0 === count($this->errors);
    }
}
