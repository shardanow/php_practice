<?php

declare(strict_types=1);

namespace App\Exceptions;

use RuntimeException;

class SessionException extends RuntimeException
{
    public function __construct(string $message = "Session not started", int $code = 500)
    {
        parent::__construct($message, $code);
    }
}