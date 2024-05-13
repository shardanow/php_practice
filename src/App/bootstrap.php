<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php";


use App\Config\Paths;
use App\Config\Routes;
use Framework\App;

$app = new App(Paths::SOURCE . "App/container-definitions.php");

Routes::init($app);

return $app;