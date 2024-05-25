<?php

declare(strict_types=1);

namespace App\Config;

use App\Controllers\{HomeController, AboutController, AuthController};
use Framework\App;

class Routes
{
    public static function init(App $app): void
    {
        $app->route("GET", "/", [HomeController::class, 'index']);
        $app->route("GET", "/about", [AboutController::class, 'about']);
        $app->route("GET", "/registration", [AuthController::class, 'registration']);
        $app->route("POST", "/registration", [AuthController::class, 'register']);
    }
}