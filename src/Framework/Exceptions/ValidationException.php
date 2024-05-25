<?php

declare(strict_types=1);

namespace Framework\Exceptions;

use RuntimeException;

class ValidationException extends RuntimeException
{

    public function __construct(int $code, string $message)
    {
        parent::__construct($message, $code);
    }
}