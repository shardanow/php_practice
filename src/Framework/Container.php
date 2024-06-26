<?php

declare(strict_types=1);

namespace Framework;

use ReflectionClass;
use ReflectionNamedType;
use Framework\Exceptions\ContainerException;

class Container
{
    private array $containers = [];
    private array $instances = [];

    /**
     * Register a dependency in the container.
     *
     * @param string $key The identifier for the dependency.
     * @param callable $resolver The resolver function to create the dependency.
     * @return void
     */
    public function set(string $key, callable $resolver): void
    {
        $this->containers[$key] = $resolver;
    }

    /**
     * Resolve and retrieve a dependency from the container.
     *
     * @param string $key The identifier for the dependency.
     * @return mixed The resolved dependency.
     * @throws ContainerException If the dependency cannot be resolved.
     */
    public function get(string $key)
    {
        if (!array_key_exists($key, $this->containers)) {
            throw new ContainerException("Class {$key} is not exist in container.");
        }

        if (array_key_exists($key, $this->instances)) {
            return $this->instances[$key];
        }

        $factory = $this->containers[$key] ?? null;
        $instance = $factory();

        $this->instances[$key] = $instance;

        return $instance;
    }

    /**
     * Resolve and instantiate a class with its dependencies.
     *
     * @param string $className The class name to instantiate.
     * @return object An instance of the resolved class.
     * @throws ContainerException If the class is not instantiable or its dependencies cannot be resolved.
     */
    public function make(string $className): object
    {
        $reflector = new ReflectionClass($className);

        if (!$reflector->isInstantiable()) {
            throw new ContainerException("Class {$className} is not instantiable");
        }

        $constructor = $reflector->getConstructor();

        if (!$constructor) {
            return new $className;
        }

        $parameters = $constructor->getParameters();

        if (empty($parameters)) {
            return new $className;
        }

        $dependencies = [];

        foreach ($parameters as $parameter) {
            $name = $parameter->getName();
            $type = $parameter->getType();

            if (!$type || !$type instanceof ReflectionNamedType || $type->isBuiltin()) {
                throw new ContainerException("Failed to resolve class {$name} because it is invalid.");
            }

            $dependencies[] = $this->get($type->getName());
        }

        return $reflector->newInstanceArgs($dependencies);
    }
}
