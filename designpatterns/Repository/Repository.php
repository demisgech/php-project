<?php

declare(strict_types=1);

require_once "autoload.php";

interface Repository
{

    public function findById(int $id): ?User;

    public function findAll(): ?array;

    public function save(User $user): bool;

    public function delete(int $id): bool;
}