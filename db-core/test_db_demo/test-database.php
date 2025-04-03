<?php

declare(strict_types=1);

require "db-core/Database.php";

try {
    $dbConnection = new RepositoryDatabase(
        "mysql:host=localhost;port=3306;dbname=school",
        "root",
        "MyPassword"
    );
    echo "Successfully connected \n";
    $sql = <<<SQL
            INSERT INTO users ( username,password,email,role)
            VALUES(?,?,?,?)
        SQL;

//    $dbConnection->query($sql, ['alex', password_hash('alex', PASSWORD_DEFAULT), 'alex@gamail.com', 'guest']);

    $sql = <<<SQL
            DELETE FROM users
            WHERE id = ?
         SQL;
//    $dbConnection->delete($sql, ['9']);

    $statement = $dbConnection->query("SELECT * FROM users");
    $queryResult = $statement->fetchAll();
    echo json_encode($queryResult, JSON_PRETTY_PRINT);
} catch (PDOException $ex) {
    echo $ex->getMessage();
}


