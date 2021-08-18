<?php

declare(strict_types=1);

namespace App\Shared\Http\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

final class SuccessResponse extends JsonResponse
{
    public function __construct()
    {
        parent::__construct(['message' => ResponseMessageEnum::OK]);
    }
}
