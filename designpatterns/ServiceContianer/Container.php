<?php

declare(strict_types=1);

class Container
{
    protected array $bindings = [];
    protected array $singletons = [];

    //    Bind a class or an interface to its concrete implementation
    public function bind(string $abstract, string|callable|null $concrete = null, bool $singleton = false): void
    {
        if (!$concrete)
            $concrete = $abstract;

        $this->bindings[$abstract] = [
            "concrete" => $concrete,
            "singleton" => $singleton
        ];
    }

    // Bind singleton classes
    public function singleton(string $abstract, string|callable|null $concrete = null): void
    {
        $this->bind($abstract, $concrete, true);
    }

    // Make or resolve a class instance
    public function make(string $abstract)
    {
        // Return the singleton if it is already resolved
        if (array_key_exists($abstract, $this->singletons))
            return $this->singletons[$abstract];

        // Not bound? Assume concrete = abstract

        $concrete = $this->bindings[$abstract]['concrete'] ?? $abstract;

        // if it is a closure call it otherwise resolve it
        if ($concrete instanceof Closure)
            $object = $concrete($this);
        else
            $object = $this->resolve($concrete);

        // Store singleton if needed

        if (!empty($this->bindings[$abstract]['singleton']))
            $this->singletons[$abstract] = $object;
        return $object;
    }

    /**
     * @throws \ReflectionException
     */
    private function resolve(string $class)
    {
        $reflector = new ReflectionClass($class);

        if (!$reflector->isInstantiable())
            throw new ReflectionException("Class $class is not instantaible!!");

        $constructor = $reflector->getConstructor();
        if (!$constructor)
            return new $class;

        $parameters = $constructor->getParameters();
        $dependencies = [];
        foreach ($parameters as $parameter) {
            $parameterType = $parameter->getType();
            if (!$parameterType || $parameterType->isBuiltin())
                throw new ReflectionException("Cannot resolve dependency $parameter->name");
            $dependencies[] = $this->make($parameterType->getName());
        }
        return $reflector->newInstanceArgs($dependencies);
    }
}





