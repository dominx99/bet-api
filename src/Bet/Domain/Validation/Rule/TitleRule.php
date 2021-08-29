<?php

declare(strict_types=1);

namespace App\Bet\Domain\Validation\Rule;

use App\Shared\Domain\Validation\RuleInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

final class TitleRule implements RuleInterface
{
    /** @return \Symfony\Component\Validator\Constraint[] */
    public static function getConstraints(): array
    {
        return [
            new NotBlank(),
            new Length(null, 2, 64),
        ];
    }
}
