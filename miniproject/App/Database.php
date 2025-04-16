<?php

declare(strict_types=1);

require_once "config.php";

// The singleto design pattern
class Database
{
    private ?PDO $connection;
    private static ?Database $databaseInstance = null;
    private PDOStatement $statement;

    private function __construct()
    {
        try {
            $engine = DB_CONFIG['engine'];
            $databaseServerName = $engine . ":" . http_build_query(DB_CONFIG['database'], "", ";");
            $user = DB_CONFIG['user'];
            $password = DB_CONFIG['password'];

            $this->connection = new PDO(
                $databaseServerName,
                $user,
                $password,
                [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
            );
        } catch (PDOException $ex) {
            throw $ex;
        }
    }

    public static function getDatabaseInstance(): ?Database
    {
        if (static::$databaseInstance === null)
            self::$databaseInstance = new Database();
        return static::$databaseInstance;
    }

    public function closeDatabaseInstance(): void
    {
        static::$databaseInstance = null;
    }

    public function query(string $query, ?array $params = [], ?array $options = [])
    {
        $this->statement = $this->connection->prepare($query, $options ?? []);
        $this->statement->execute($params ?? []);
        return $this;
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();

        if (!$result)
            abort();
        return $result;
    }

    public function fetchAll()
    {
        return $this->statement->fetchAll();
    }
}
