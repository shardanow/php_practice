<?php

declare(strict_types=1);

namespace Framework;

class App
{
    private Router $router;

    public function __construct()
    {
        $this->router = new Router();
    }

    public function run()
    {
        $path = $_SERVER["PATH_INFO"] ?? "/";
        $method = $_SERVER["REQUEST_METHOD"];

        $this->router->dispatch($method, $path);
    }

    public function getPage(string $method, string $path, array $controller): void
    {
        $this->router->setRoute($method, $path, $controller);
    }
}
