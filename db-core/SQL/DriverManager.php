<?php

declare(strict_types=1);

namespace SQL;

use PDO;
use RuntimeException;

class DriverManager
{
    private static ?PDO $connection = null;

    public static function getConnection(
        string $databaseServerName,
        string $username = 'root',
        string $password = '',
        ?array $options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    )
    {
        if (self::$connection == null) {
            try {
                self::$connection = new PDO(
                    $databaseServerName, $username,
                    $password, $options ?? []
                );
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (RuntimeException $ex) {
                throw new RuntimeException("Database connection Failed: " . $ex->getMessage());
            }
        }
        return self::$connection;
    }

    public static function closeConnection()
    {
        if (self::$connection)
            self::$connection = null;
    }
}