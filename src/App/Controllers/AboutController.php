<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Config\Paths;

use Framework\TemplateEngine;

class AboutController
{
    private TemplateEngine $view;

    public function __construct()
    {
        $this->view = new TemplateEngine(Paths::VIEWS);
    }

    public function about()
    {
        echo $this->view->render("about", [
            "title" => "About",
            "description" => "A simple PHP framework",
        ]);
    }
}