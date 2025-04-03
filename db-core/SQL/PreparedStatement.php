<?php

declare(strict_types=1);

namespace SQL;

use PDOStatement;
use PDO;

class PreparedStatement
{
    private PDOStatement $statement;

    public function __construct(PDO $connection, $query)
    {
        $this->statement = $connection->prepare($query);
    }

    public function execute(array $options = []): bool
    {
        return $this->statement->execute($options);
    }

    public function getResultSet(): ResultSet
    {
        return new ResultSet($this->statement);
    }

    public function getUpdateCount(): int
    {
        return $this->statement->rowCount();
    }
}