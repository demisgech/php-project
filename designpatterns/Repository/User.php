<?php

declare(strict_types=1);

class User
{
    public function __construct(
        private readonly int $id,
        private string       $firstName,
        private string       $lastName,
        private string       $email,
        private string       $password
    )
    {
    }

    public final function getId(): int
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }
}