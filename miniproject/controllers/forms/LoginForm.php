<?php

declare(strict_types=1);

class LoginForm
{
    private static array $errors = [];

    public static function validate(string $email, string $password): bool
    {
        if (!Validator::validateEmail($email))
            static::$errors['email'] = 'This field is required!!';

        if (!Validator::validateString($password))
            static::$errors['password'] = "This field is required!!";

        return empty(static::$errors);
    }

    public static function errors(): array
    {
        return static::$errors;
    }

    public static function error(string $key, string $message): void
    {
        static::$errors[$key] = $message;
    }

}