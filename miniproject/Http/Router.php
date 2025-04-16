<?php

declare(strict_types=1);

class Router
{
    public function route(string $path, string $method = "GET")
    {
        if ($method === $_SERVER['REQUEST_METHOD'])
            if (file_exists($path))
                require_once $path;
            else
                abort();
    }

    public function get(string $url)
    {

    }

    public function post(string $url, array $data)
    {

    }

    public function put(string $url, array $data)
    {

    }

    public function patch(string $url, array $data)
    {

    }

    public function delete(string $url)
    {

    }

    protected function abort(int $statusCode = 404)
    {
        http_response_code($statusCode);

        view("$statusCode.view.php");
        die();
    }
}