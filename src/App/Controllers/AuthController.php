<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\ValidatorService;

class AuthController
{
    private TemplateEngine $view;
    private ValidatorService $validator;

    public function __construct(TemplateEngine $view, ValidatorService $validator)
    {
        $this->view = $view;
        $this->validator = $validator;
    }

    public function registration()
    {
        echo $this->view->render("registration", [
            "page" => "Registration",
            "description" => "A simple PHP framework",
        ]);
    }

    public function register()
    {
        $data = [
            "name" => $_POST["username"],
            "email" => $_POST["email"],
            "password" => $_POST["password"],
        ];

        $rules = [
            "name" => ["required", "min"],
            "email" => ["required", "email"],
            "password" => ["required", "min"],
        ];

        $errors = $this->validator->validate($data, $rules);

        if (count($errors) > 0) {
            echo $this->view->render("registration", [
                "page" => "Registration",
                "description" => "A simple PHP framework",
                "errors" => $errors,
            ]);
        } else {
            echo "Registration successful!";
        }
    }
}