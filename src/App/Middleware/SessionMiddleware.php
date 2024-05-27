<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use App\Exceptions\SessionException;

class SessionMiddleware implements MiddlewareInterface
{
    public function process(callable $middleware): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            throw new SessionException("Session already started!");
        }

        if (headers_sent($file, $line)) {
            throw new SessionException("Headers already sent! Output started at $file:$line");
        }

        session_start();

        $middleware();

        session_write_close();
    }
}