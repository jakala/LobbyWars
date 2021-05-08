<?php
namespace App\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

final class HealthCheckController
{
    public function __invoke()
    {
        return new JsonResponse(
            ['status' => 'ok']
        );
    }
}