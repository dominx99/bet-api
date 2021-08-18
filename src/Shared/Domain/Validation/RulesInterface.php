<?php

declare(strict_types=1);

namespace App\Shared\Domain\Validation;

interface RulesInterface
{
    public static function getRules(): array;
}
