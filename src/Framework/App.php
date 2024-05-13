<?php

declare(strict_types=1);

namespace Framework;

class App
{
    private Router $router;
    private Container $container;

    public function __construct(string $containerDefinitionsPath = null)
    {
        $this->router = new Router();
        $this->container = new Container();

        if ($containerDefinitionsPath) {
            $containerDefinitons = require $containerDefinitionsPath;

            foreach ($containerDefinitons as $key => $resolver) {
                $this->container->set($key, $resolver);
            }
        }
    }

    public function run()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? "/";
        $method = $_SERVER["REQUEST_METHOD"];

        $this->router->dispatch($method, $path, $this->container);
    }

    public function getPage(string $method, string $path, array $controller): void
    {
        $this->router->setRoute($method, $path, $controller);
    }
}
