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

            // session 
            $_SESSION['errors'] = $e->getMessage();

            //set the response code
            http_response_code($e->getCode());

            //redirect to the previous page
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}