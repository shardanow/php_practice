<?php

declare(strict_types=1);

namespace Tests\Controllers;

use App\Controllers\HomeController;
use Framework\TemplateEngine;
use PHPUnit\Framework\TestCase;

use App\Config\Paths;

class HomeControllerTest extends TestCase
{
    public function testIndex()
    {
        $view = new TemplateEngine(Paths::VIEWS);
        $controller = new HomeController($view);

        $expected = $view->render("index", [
            "title" => "Home",
            "description" => "A simple PHP framework",
        ]);

        $this->expectOutputString($expected);

        $controller->index();
    }
}
