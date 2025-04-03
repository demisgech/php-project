<?php

declare(strict_types=1);

require_once "autoload.php";

try {
    $db = RepositoryDatabase::getConnection(
        "mysql:host=localhost;port=3306;dbname=school",
        "root",
        "MyPassword"
    );

    $userMapper = new UserMapper($db);
    $userRepository = new UserRepository($userMapper);
    $userOne = new User(
        7,
        "Dereje",
        "Tesfaye",
        "dereje@gmail.com",
        "de123"
    );
    $userRepository->save($userOne);

    RepositoryDatabase::closeConnection();
} catch (PDOException $ex) {
    echo "Error: " . $ex->getMessage();
}