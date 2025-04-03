<?php

declare(strict_types=1);

namespace SQL;

use PDOStatement;
use PDO;

class ResultSet
{
    public function __construct(private PDOStatement $statement)
    {

    }

    public function fetchAll()
    {
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchOne(): ?array
    {
        return $this->statement->fetch(PDO::FETCH_ASSOC) ?: null;
    }

}