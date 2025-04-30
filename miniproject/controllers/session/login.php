<?php

declare(strict_types=1);

require_once("controllers/forms/LoginForm.php");
require_once("controllers/forms/Authenticator.php");

$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

$loggedIn = Authenticator::attempt($attributes['email'], $attributes['password']);

if (!$loggedIn) {
    $form->error(
        "login_failed", "Incorrect email or password!!!"
    )->throw();
}

redirect("/");





