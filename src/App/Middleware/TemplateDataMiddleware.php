<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\TemplateEngine;

class TemplateDataMiddleware implements MiddlewareInterface
{
    private TemplateEngine $view;

    public function __construct(TemplateEngine $view)
    {
        $this->view = $view;
    }

    public function process(callable $middleware): void
    {
        $this->view->addGlobalData("title", 'Practical PHP Web Development');

        $middleware();
    }
}