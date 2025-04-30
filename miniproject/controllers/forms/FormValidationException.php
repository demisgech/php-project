<?php

declare(strict_types=1);

class FormValidationException extends Exception
{
    private array $errors = [];
    private array $staileData = [];

    public function __construct($errors, $staileData)
    {
        parent::__construct("");
        $this->errors = $errors;
        $this->staileData = $staileData;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getStaileData(): array
    {
        return $this->staileData;
    }
}
