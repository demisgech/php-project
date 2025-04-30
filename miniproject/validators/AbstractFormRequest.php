<?php

declare(strict_types=1);

abstract class AbstractFormRequest
{
    protected array $errors = [];
    protected array $validData = [];

    abstract public function rules(): array;


    public function validate(array $data): bool
    {
        $validator = new Validator($data, $this->rules());
        if ($validator->validate()) {
            $this->validData = $validator->validData();
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function validData(): array
    {
        return $this->validData;
    }
}