<?php

declare(strict_types=1);

namespace App\Account\Domain\Validation\Rule\User;

use App\Shared\Domain\Validation\RuleInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

final class EmailRule implements RuleInterface
{
    /** @return Constraint[] */
    public static function getConstraints(): array
    {
        return [
            new Email(),
            new NotBlank(),
        ];
    }
}
