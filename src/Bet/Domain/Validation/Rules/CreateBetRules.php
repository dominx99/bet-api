<?php

declare(strict_types=1);

namespace App\Bet\Domain\Validation\Rules;

use App\Bet\Domain\Validation\Rule\TitleRule;
use App\Shared\Domain\Validation\RulesInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\NotBlank;

final class CreateBetRules implements RulesInterface
{
    public static function getRules(): array
    {
        return [
            'title' => TitleRule::getConstraints(),
            'startDate' => [
                new NotBlank(),
                new DateTime(),
            ],
            'endDate' => [
                new DateTime(),
            ],
        ];
    }
}
