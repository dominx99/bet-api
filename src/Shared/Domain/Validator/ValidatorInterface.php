<?php

declare(strict_types=1);

namespace App\Shared\Domain\Validator;

use App\Shared\ValueObject\ValidationResult;

interface ValidatorInterface
{
    public function validate(array $parameters, array $rules): ValidationResult;
}
