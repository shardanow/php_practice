<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\TemplateEngine;
use App\Exceptions\SessionException;

class FlashMiddleware implements MiddlewareInterface
{
    private TemplateEngine $templateEngine;


    public function __construct(TemplateEngine $templateEngine)
    {
        $this->templateEngine = $templateEngine;
    }

    public function process(callable $middleware): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            throw new SessionException("Session not started!");
        }

        $this->templateEngine->addGlobalData("errors", $_SESSION['errors'] ?? []);

        unset($_SESSION['errors']);

        $middleware();
    }
}