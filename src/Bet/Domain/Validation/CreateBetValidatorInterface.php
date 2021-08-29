<?php

declare(strict_types=1);

namespace App\Bet\Domain\Validation;

use App\Shared\ValueObject\ValidationResult;

interface CreateBetValidatorInterface
{
    public function validate(array $parameters): ValidationResult;
}
