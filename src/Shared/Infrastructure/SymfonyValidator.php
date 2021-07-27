<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure;

use App\Shared\Domain\Exception\ValidationException;
use App\Shared\Domain\Validator\ValidatorInterface;
use App\Shared\ValueObject\ErrorBag;
use App\Shared\ValueObject\ValidationResult;
use RuntimeException;
use Symfony\Component\Validator\Validator\ValidatorInterface as SymfonyValidatorInterface;

final class SymfonyValidator implements ValidatorInterface
{
    public function __construct(
        private SymfonyValidatorInterface $validator,
    ) {
    }

    public function validate(array $parameters, array $rules): ValidationResult
    {
        $errorBag = new ErrorBag();

        foreach ($rules as $ruleKey => $constraints) {
            if (!in_array($ruleKey, array_keys($parameters))) {
                throw new RuntimeException(sprintf('Parameter with %s key does not exist.', $ruleKey));
            }

            $violations = $this->validator->validate($parameters[$ruleKey], $constraints);

            $errors = [];

            /** @var \Symfony\Component\Validator\ConstraintViolationInterface $violation */
            foreach ($violations as $violation) {
                array_push($errors, $violation->getMessage());
            }
            $errorBag->set($ruleKey, $errors);
        }

        if (!$errorBag->isEmpty()) {
            throw ValidationException::withMessages($errorBag->all());
        }

        return new ValidationResult($errorBag);
    }
}
