<?php

declare(strict_types=1);

namespace App\Account\Infrastructure\Validation;

use App\Account\Domain\Repository\UserRepositoryInterface;
use App\Account\Domain\Validation\CreateUserValidatorInterface;
use App\Account\Domain\Validation\Rules\User\CreateUserRules;
use App\Shared\Domain\Exception\ValidationException;
use App\Shared\Domain\Validator\ValidatorInterface;
use App\Shared\ValueObject\ErrorBag;
use App\Shared\ValueObject\ValidationResult;

final class CreateUserValidator implements CreateUserValidatorInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private ValidatorInterface $validator,
    ) {
    }

    public function validate(array $parameters): ValidationResult
    {
        $validationResult = $this->validator->validate($parameters, CreateUserRules::getRules());

        if (!$validationResult->isValid()) {
            return $validationResult;
        }

        $errorBag = new ErrorBag();

        if ($this->userRepository->existByEmail($parameters['email'])) {
            $errorBag->set('email', ['Email must be unique.']);

            throw ValidationException::withMessages($errorBag->all());
        }

        return new ValidationResult($errorBag);
    }
}
