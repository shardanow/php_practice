<?php

declare(strict_types=1);

namespace Framework;

class Router
{
    private array $routes = [];
    private array $middlewares = [];

    public function __construct(array $routes = [])
    {
        $this->routes = $routes;
    }

    public function setRoute(string $method, string $path, array $controller): void
    {
        $path = $this->normalizePath($path);

        $this->routes[] = [
            "method" => strtoupper($method),
            "path" => $path,
            "controller" => $controller
        ];
    }

    private function normalizePath(string $path): string
    {
        // Remove trailing slashes if path is equal to "/" else add trailing slashes to the path end and start
        return $path !== "/" ? "/" . trim($path, "/") . "/" : $path;
    }

    public function dispatch(string $method, string $path, Container $container = null): void
    {
        $path = $this->normalizePath($path);
        $method = strtoupper($method);

        foreach ($this->routes as $route) {
            [$class, $classMethod] = $route["controller"];

            if ($route["method"] === $method && $route["path"] === $path) {
                $comtrollerInstance = $container ? $container->make($class) : new $class();
                $action = fn() => $comtrollerInstance->{$classMethod}();

                foreach ($this->middlewares as $middleware) {
                    $middlewareInstance = $container ? $container->make($middleware) : new $middleware();
                    $action = fn() => $middlewareInstance->process($action);
                }

                $action();

                return;
            }
        }
    }

    public function setMiddlewares(string $middleware): void
    {
        $this->middlewares[] = $middleware;
    }
}