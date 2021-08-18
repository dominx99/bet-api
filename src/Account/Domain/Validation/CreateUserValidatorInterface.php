<?php

declare(strict_types=1);

namespace App\Account\Domain\Validation;

use App\Shared\ValueObject\ValidationResult;

interface CreateUserValidatorInterface
{
    public function validate(array $parameters): ValidationResult;
}
