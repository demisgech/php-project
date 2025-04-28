<?php

declare(strict_types=1);


class Session
{
    public static function has(string $key): bool
    {
        return (bool)static::get($key);
    }

    public static function put(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key, mixed $default = null)
    {
        return $_SESSION['_flashed'][$key] ?? $_SESSION[$key] ?? $default;
    }

    public static function flash(string $key, mixed $value): void
    {
        $_SESSION["_flashed"][$key] = $value;
    }

    public static function unflash(): void
    {
        unset($_SESSION['_flashed']);
    }

    public static function flush(): void
    {
        $_SESSION = [];
    }

    public static function destroy(): void
    {
        static::flush();
        session_destroy();
        $cookieParams = session_get_cookie_params();
        setcookie(
            name: "PHPSESSID",
            value: "",
            expires_or_options: time() - 3600, // 1hr
            path: $cookieParams['path'],
            domain: $cookieParams['domain'],
            secure: $cookieParams['secure'],
            httponly: $cookieParams['httponly']
        );
    }

    public static function old(string $key, mixed $default = '')
    {
        return Session::get('old')[$key] ?? $default;
    }
}