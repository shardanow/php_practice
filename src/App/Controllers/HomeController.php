<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Config\Paths;

use Framework\TemplateEngine;

class HomeController
{
    private TemplateEngine $view;

    public function __construct()
    {
        $this->view = new TemplateEngine(Paths::VIEWS);
    }

    public function index()
    {
        echo $this->view->render("index", [
            "title" => "Home",
            "description" => "A simple PHP framework",
        ]);
    }
}