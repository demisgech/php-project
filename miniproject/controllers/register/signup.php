<?php

declare(strict_types=1);
global $errors;
//header("Content-Type: Application/json");

require_once("Http/Validator.php");
require_once("App/getDBConnection.php");
require_once("utils/utils.php");
require_once("controllers/forms/Authenticator.php");

$users = [
    [
        'id' => 1,
        'username' => "Demis",
        "email" => "demis@domain.com",
        "fisrt_name" => "Demis",
        "last_name" => "Getachew",
        "password" => "12345678"
    ],
    [
        'id' => 2,
        'username' => "Dereje",
        "email" => "dereje@domain.com",
        "first_name" => "Dereje",
        "last_name" => "Tesifaye",
        "password" => "13s;lhfa"
    ],
    [
        'id' => 3,
        'username' => "Hailer",
        "email" => "haile@domain.com",
        "first_name" => "Haile",
        "last_name" => "Getaneh",
        "password" => "sdafkjhdg"
    ],
];
//echo json_encode($users);

//echo json_encode([$_POST]);
//echo "Registered!!!";


$errors = [];
$username = $_POST['username'];
if (!Validator::validateString($username))
    $errors['username'] = "Please enter valid value!!!";

$firstName = $_POST['first_name'];
if (!Validator::validateString($firstName))
    $errors['first_name'] = "Please enter valid value!!!";

$lastName = $_POST['last_name'];
if (!Validator::validateString($lastName))
    $errors['last_name'] = "Please enter valid value!!!";

$email = $_POST['email'];
if (!Validator::validateEmail($email))
    $errors['email'] = "Please enter valid email!!!";

$password = $_POST['password'];
if (!Validator::validateString($password, 7, 255))
    $errors['password'] = "Please provide valid password length between 7 and 255 characters!!!";

if (count($errors) > 0) {
    return view("register/create.view.php");
}
try {
    $db = getDBConnection();

    $sql = <<<SQL
            CREATE TABLE IF NOT EXISTS users (
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                username VARCHAR(150) NOT NULL UNIQUE,
                first_name VARCHAR(150),
                last_name VARCHAR(150),
                email VARCHAR(150) UNIQUE,
                password VARCHAR(255)
            );
            SQL;
    $db->query($sql);

    $sql = <<<SQL
            INSERT INTO users ( username,first_name ,last_name ,email,password)
            VALUES ( :username, :first_name, :last_name, :email, :password );
           SQL;

//    foreach ($users as $user):
//        $db->query($sql, [
//            'username' => $user['username'],
//            'first_name' => $user['first_name'],
//            'last_name' => $user['last_name'],
//            'email' => $user['email'],
//            'password' => $user['password']
//        ]);
//    endforeach;

    $db->query($sql, [
        'username' => $username,
        'first_name' => $firstName,
        'last_name' => $lastName,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    $sql = <<<SQL
         SELECT * FROM users
         WHERE email = :email;
        SQL;

    $user = $db->query($sql, [
        'email' => $email
    ])->find();

    if ($user)
        Authenticator::login([
            "email" => $user['email']
        ]);

    $db->closeDatabaseInstance();
} catch (RuntimeException $ex) {
    echo $ex->getMessage();
}

redirect("/login");