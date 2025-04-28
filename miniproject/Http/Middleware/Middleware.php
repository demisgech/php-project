<?php

declare(strict_types=1);

require_once "Auth.php";
require_once "Guest.php";

class Middleware
{
    private const middlewares = [
        'guest' => Guest::class,
        'auth' => Auth::class
    ];

    public static function resolve(string $key)
    {
        if (!array_key_exists($key, static::middlewares))
            return;

        $middleware = static::middlewares[$key];
        (new $middleware())->handle();
    }
}