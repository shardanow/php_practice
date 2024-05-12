<?php

declare(strict_types=1);

namespace App\Config;

use App\Controllers\{HomeController, AboutController};
use Framework\App;

class Routes
{
    public static function init(App $app): void
    {
        $app->getPage("GET", "/", [HomeController::class, 'index']);
        $app->getPage("GET", "/about", [AboutController::class, 'about']);
    }
}