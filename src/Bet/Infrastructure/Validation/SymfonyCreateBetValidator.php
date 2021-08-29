<?php

declare(strict_types=1);

namespace App\Bet\Infrastructure\Validation;

use App\Bet\Domain\Validation\CreateBetValidatorInterface;
use App\Bet\Domain\Validation\Rules\CreateBetRules;
use App\Shared\Domain\Validator\ValidatorInterface;
use App\Shared\ValueObject\ValidationResult;

final class SymfonyCreateBetValidator implements CreateBetValidatorInterface
{
    public function __construct(
        private ValidatorInterface $validator,
    ) {
    }

    public function validate(array $parameters): ValidationResult
    {
        return $this->validator->validate($parameters, CreateBetRules::getRules());
    }
}
