<?php

declare(strict_types=1);

require_once "autoload.php";

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
            WHERE id = :id;
        SQL;
        $statement = $this->pdo->prepare($sql);
        $statement->execute(["id" => $id]);

        $fetchedUser = $statement->fetch(PDO::FETCH_ASSOC);

        return $fetchedUser ? new User(
            $fetchedUser['id'],
            $fetchedUser['first_name'],
            $fetchedUser['last_name'],
            $fetchedUser['email'],
            $fetchedUser['password']
        ) : null;
    }

    public function findAll(): ?array
    {
        $sql = <<<SQL
                SELECT * FROM users
            SQL;
        $statement = $this->pdo->query($sql);
        $users = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new User(
                $row['id'],
                $row['first_name'],
                $row['last_name'],
                $row['email'],
                $row['password']
            );
        }
        return $users ?? null;
    }

    public function insert(User $user): bool
    {
        $sql = <<<SQL
             INSERT INTO users (
                            first_name,
                            last_name,
                            email,
                            password)
             VALUES ( ?, ?, ?, ?);
            SQL;
        $statement = $this->pdo->prepare($sql);
        return $statement->execute([
            $user->getFirstName(),
            $user->getLastName(),
            $user->getEmail(),
            password_hash($user->getPassword(), PASSWORD_DEFAULT)
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
             WHERE id = :id;
            SQL;
        $statement = $this->pdo->prepare($sql);
        return $statement->execute([
            "firstName" => $user->getFirstName(),
            "lastName" => $user->getLastName(),
            "email" => $user->getEmail(),
            "password" => password_hash($user->getPassword(), PASSWORD_DEFAULT),
            "id" => $user->getId()
        ]);
    }

    public function delete(int $id): bool
    {
        $sql = <<<SQL
                DELETE FROM users
                WHERE id = :id;
            SQL;
        $statement = $this->pdo->prepare($sql);
        return $statement->execute(["id" => $id]);
    }

}