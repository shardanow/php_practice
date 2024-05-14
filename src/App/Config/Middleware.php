<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Middleware\TemplateDataMiddleware;

class Middleware
{
    public static function init(App $app): void
    {
        $app->addMiddleware(TemplateDataMiddleware::class);
    }
}