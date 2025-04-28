<?php

declare(strict_types=1);

require_once("Http/Validator.php");
require_once("utils/utils.php");
require_once("controllers/forms/LoginForm.php");
require_once("controllers/forms/Authenticator.php");
require_once("Http/Session.php");

$email = $_POST['email'];
$password = $_POST['password'];

$loginForm = new LoginForm();

if (LoginForm::validate($email, $password)) {
    if (Authenticator::attempt($email, $password))
        redirect("/");
    LoginForm::error("login_failed", "Incorrect email or password!!!");
}

Session::flash('errors', LoginForm::errors());
Session::flash('old', [
    'email' => $email
]);

redirect('/login');


