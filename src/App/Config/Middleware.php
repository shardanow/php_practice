<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Middleware\{TemplateDataMiddleware, ValidationExceptionMiddleware, SessionMiddleware, FlashMiddleware};

class Middleware
{
    public static function init(App $app): void
    {
        $app->addMiddleware(TemplateDataMiddleware::class);
        $app->addMiddleware(ValidationExceptionMiddleware::class);
        $app->addMiddleware(FlashMiddleware::class);
        $app->addMiddleware(SessionMiddleware::class);
    }
}