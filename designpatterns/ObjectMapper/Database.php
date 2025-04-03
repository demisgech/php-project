<?php

class Database
{
    private static ?PDO $pdo = null;

    /**
     * @throws RuntimeException
     */
    public static function getConnection(
        string $databaseServerName,
        string $username,
        string $password,
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
        return self::$pdo;
    }
    
    public static function closeConnection(): void
    {
        if (self::$pdo !== null)
            self::$pdo = null;
    }
}