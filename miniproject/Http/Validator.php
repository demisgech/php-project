<?php

declare(strict_types=1);

class Validator

{
    static public function validateString(
        string $value,
        int    $minLength = 1,
        int    $maxLength = PHP_INT_MAX): bool
    {
        $result = trim($value);

        $stringLength = strlen($result);
        return ($stringLength >= $minLength && $stringLength <= $maxLength);
    }

    public static function validateEmail(string $email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}