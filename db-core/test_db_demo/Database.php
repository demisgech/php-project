<?php

declare(strict_types=1);

require_once "config.php";

class Database
{
    private ?PDO $connection;

    public function __construct(
        private string $databaseServerName,
        private string $username = "root",
        private string $password = "",
        private array  $option = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    )
    {


        echo "mysql:" . http_build_query(DB_CONFIG['database'], '', ';') . "\n";
        $this->connection = new PDO(
            "mysql:" . http_build_query(DB_CONFIG, '', ';'),
            'root',
            'MyPassword'
        );

        try {
            $this->connection = new PDO(
                $this->databaseServerName,
                $this->username,
                $this->password,
                $this->option ?? []
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            throw $ex;
        }
    }

    public function query(string $query, ?array $params = [], ?array $options = [])
    {
        $statement = $this->connection->prepare($query, $options);
        $statement->execute($params);

        return $statement;
    }

//    public function delete(string $tableName,?array $params = [])
//    {
//
//        $tableName = trim($tableName);
//        $sql = <<<SQL
//                    DELETE * FROM $tableName
//                    WHERE id = ?
//               SQL;
//        $statement = $this->connection->prepare($sql);
//        $statement->execute($params);
//        return $statement;
//    }

}