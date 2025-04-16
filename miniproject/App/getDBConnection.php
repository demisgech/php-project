<?php

declare(strict_types=1);

require_once "Database.php";
function getDBConnection(): Database
{
    return Database::getDatabaseInstance();
}
