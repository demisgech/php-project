<?php

declare(strict_types=1);

require_once "FormValidationException.php";
require_once "Http/Validator.php";

class LoginForm
{
    private array $errors = [];

    public function __construct(private readonly array $attributes)
    {

        if (!Validator::validateEmail($attributes['email']))
            $this->errors['email'] = 'This field is required!!';

        if (!Validator::validateString($attributes['password']))
            $this->errors['password'] = "This field is required!!";
    }

    public static function validate(array $attributes): static
    {
        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;
    }

    public function failed(): bool
    {
        return count($this->errors) > 0;
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function error(string $key, string $message): static
    {
        $this->errors[$key] = $message;
        return $this;
    }

    /**
     * @throws FormValidationException
     */
    function throw()
    {
        throw new FormValidationException($this->errors(), $this->attributes);
    }

}