<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\Exceptions\ValidationException;

class ValidationExceptionMiddleware implements MiddlewareInterface
{
    public function process(callable $middleware): void
    {
        try {
            $middleware();
        } catch (ValidationException $e) {
            http_response_code($e->getCode());
            echo $e->getMessage();
        }
    }
}