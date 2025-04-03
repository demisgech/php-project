<?php

declare(strict_types=1);

require "autoload.php";

class UserMapper
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findById(int $id): ?User
    {
        $sql = <<<SQL
                SELECT * FROM users
                WHERE id = :id
              SQL;
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $id]);
        $fetchdResult = $statement->fetch(PDO::FETCH_ASSOC);

        if ($fetchdResult == null)
            return null;

        return new User(
            $fetchdResult['id'],
            $fetchdResult['first_name'],
            $fetchdResult['last_name'],
            $fetchdResult['email'],
            $fetchdResult['password']
        );
    }

    public function insert(User $user): bool
    {
        $sql = <<<SQL
            INSERT INTO users (first_name, last_name, email, password)
            VALUES ( ?, ?, ?, ?);
            SQL;

        $statement = $this->pdo->prepare($sql);
        return $statement->execute([
            $user->getFirstName(),
            $user->getLastName(),
            $user->getEmail(),
            $user->getPassword()
        ]);
    }

    public function update(User $user): bool
    {
        $sql = <<<SQL
             UPDATE users SET
                    first_name = :firstName,
                    last_name = :lastName,
                    email = :email,
                    password = :password
             WHERE id = :id
            SQL;
        $statement = $this->pdo->prepare($sql);
        return $statement->execute([
            "firstName" => $user->getFirstName(),
            "lastName" => $user->getLastName(),
            "email" => $user->getEmail(),
            "password" => $user->getPassword(),
            "id" => $user->getId()
        ]);
    }

    public function delete(int $id): bool
    {
        $sql = <<<SQL
                DELETE FROM users
                WHERE id= :id;
            SQL;
        $statement = $this->pdo->prepare($sql);
        return $statement->execute(['id' => $id]);
    }

}