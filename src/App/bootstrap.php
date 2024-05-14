<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php";


use App\Config\Paths;
use App\Config\Routes;
use App\Config\Middleware;
use Framework\App;

$app = new App(Paths::SOURCE . "App/container-definitions.php");

Routes::init($app);
Middleware::init($app);

return $app;