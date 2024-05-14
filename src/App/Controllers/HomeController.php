<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

class HomeController
{
    private TemplateEngine $view;

    public function __construct(TemplateEngine $view)
    {
        $this->view = $view;
    }

    public function index()
    {
        echo $this->view->render("index", [
            //"title" => "Home",
            "description" => "A simple PHP framework",
        ]);
    }
}