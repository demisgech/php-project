<?php

declare(strict_types=1);

namespace SQL;

use PDO;

class Statement
{

    public function __construct(private PDO $connection)
    {
    }

    public function executeQuery(string $query): ResultSet
    {
        $statement = $this->connection->query($query);
        return new ResultSet($statement);
    }

    public function executeUpdate(string $query): int|false
    {
        return $this->connection->exec($query);
    }

}