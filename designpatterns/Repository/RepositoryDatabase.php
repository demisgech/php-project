<?php

declare(strict_types=1);


class RepositoryDatabase
{
    private static ?PDO $pdo;

    public static function getConnection(
        string $databaseServerName,
        string $username = "root",
        string $password = "",
        ?array $options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    ): ?PDO
    {

        try {
            self::$pdo = new PDO(
                $databaseServerName,
                $username,
                $password,
                $options ?? []
            );
            self::$pdo->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        } catch (RuntimeException $ex) {
            throw $ex;
        }
        return self::$pdo ?? null;
    }

    public static function closeConnection(): void
    {
        if (self::$pdo !== null)
            self::$pdo = null;
    }
}