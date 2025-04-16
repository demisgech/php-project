<?php

declare(strict_types=1);


class UserService
{
    private Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function createUser(string $name)
    {
        $this->logger->log("User $name created.");
    }
}