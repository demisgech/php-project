<?php

declare(strict_types=1);

require_once "Middleware/Middleware.php";

class Router
{
    protected array $routes = [];

    private function add(string $path, string $controller, string $method)
    {
        $this->routes[] = [
            'path' => $path,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];
        return $this;
    }

    public function get(string $path, string $controller)
    {
        return $this->add($path, $controller, "GET");
    }

    public function post(string $path, string $controller)
    {
        return $this->add($path, $controller, "POST");
    }

    public function put(string $path, string $controller)
    {
        return $this->add($path, $controller, "PUT");
    }

    public function patch(string $path, string $controller)
    {
        return $this->add($path, $controller, "PATCH");

    }

    public function delete(string $path, string $controller)
    {
        return $this->add($path, $controller, method: "DELETE");
    }

    public function only(string $key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;
        return $this;
    }

    public function resolve(string $path, string $method)
    {
        $path = parse_url($path, PHP_URL_PATH);
        $method = strtoupper($method);
        foreach ($this->routes as $route) {
            if ($route['path'] === $path && $route['method'] === $method) {
                if ($route['middleware'])
                    Middleware::resolve($route['middleware']);
                return require_once getBasePath($route['controller']);
            }
        }
        $this->abort();
    }

    protected function abort(int $statusCode = 404)
    {
        http_response_code($statusCode);

        view("$statusCode.view.php");
        die();
    }
}