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
            $oldFormData = $_POST;

            $exclude = ['password', 'password_confirmation'];

            foreach ($exclude as $field) {
                if (array_key_exists($field, $oldFormData)) {
                    unset($oldFormData[$field]);
                }
            }

            // session 
            $_SESSION['errors'] = $e->getMessage();
            $_SESSION['oldFormData'] = $oldFormData;

            //set the response code
            http_response_code($e->getCode());

            //redirect to the previous page
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}