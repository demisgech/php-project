<?php

declare(strict_types=1);

require_once "autoload.php";

class UserRepository implements Repository
{
    private UserMapper $userMapper;

    public function __construct(UserMapper $userMapper)
    {
        $this->userMapper = $userMapper;
    }

    public function findById(int $id): ?User
    {
        return $this->userMapper->findById($id);
    }

    public function findAll(): ?array
    {
        return $this->userMapper->findAll();
    }

    public function save(User $user): bool
    {
        $userInDb = $this->userMapper->findById($user->getId());
        if ($userInDb == null)
            return $this->userMapper->insert($user);
        return $this->userMapper->update($user);
    }

    public function delete(int $id): bool
    {
        return $this->delete($id);
    }
}