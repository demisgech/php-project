<?php

declare(strict_types=1);

require_once "autoload.php";

try {
    $dbPdo = Database::getConnection(
        "mysql:host=localhost;port=3306;dbname=school",
        "root",
        "MyPassword"
    );
    $userMapper = new UserMapper($dbPdo);
    $userOne = new User(
        1, "Demis",
        "Getachew",
        "demisgech@gmail.com",
        "MyPassword"
    );
//    $userMapper->insert($userOne);
    $userTwo = new User(
        5,
        "Yibekal",
        "Mare",
        "yibekal@gmail.com",
        'yibekal#43'
    );

//    $userMapper->insert($userTwo);

    $userMapper->update($userTwo);
//    $userMapper->delete(3);

    Database::closeConnection();

} catch (PDOException $ex) {
    echo "Error: " . $ex->getMessage();
}