<?php

declare(strict_types=1);

namespace App\Account\Domain\Validation\Rule\User;

use App\Shared\Domain\Validation\RuleInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

final class PasswordRule implements RuleInterface
{
    /** @return Constraint[] */
    public static function getConstraints(): array
    {
        return [
            new NotBlank(),
            new Length(null, 8, 64),
        ];
    }
}
