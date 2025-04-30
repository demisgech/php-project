<?php

declare(strict_types=1);

class RegistratioinFormRequest extends AbstractFormRequest
{
    public function rules(): array
    {
        return [
            "username" => "sanitize:trim,strip,escape|required|min:6|max:100",
            "email" => "sanitize:trim,strip,email|required|email",
            "password" => "sanitize:trim,strip|required|min:6",
        ];
    }
}