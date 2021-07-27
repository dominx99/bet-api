<?php

declare(strict_types=1);

namespace App\Shared\Domain\Rules;

interface RuleInterface
{
    public static function getConstraints(): array;
}
