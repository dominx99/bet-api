<?php

declare(strict_types=1);

namespace App\Account\Domain\Validation\Rules\User;

use App\Account\Domain\Validation\Rule\User\EmailRule;
use App\Account\Domain\Validation\Rule\User\NameRule;
use App\Account\Domain\Validation\Rule\User\PasswordRule;
use App\Shared\Domain\Validation\RulesInterface;

final class CreateUserRules implements RulesInterface
{
    public static function getRules(): array
    {
        return [
            'email' => EmailRule::getConstraints(),
            'password' => PasswordRule::getConstraints(),
            'name' => NameRule::getConstraints(),
        ];
    }
}
