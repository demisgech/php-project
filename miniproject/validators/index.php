<?php

declare(strict_types=1);

spl_autoload_register(function ($className) {
    $path = __DIR__ . "/" . str_replace("\\", DIRECTORY_SEPARATOR, $className) . ".php";
    if (file_exists($path))
        require $path;
    else
        die("$path is not found!!!");
});

$data = [
    "email" => "<br>demis@domain.com<br/>",
    "password" => "  sesjkdhfksjdhfdskfhdc",
    "username" => "@demisgech"
];

$form = new RegistratioinFormRequest();

if ($form->validate($data)) {
    $validData = $form->validData();
    echo json_encode($validData, JSON_PRETTY_PRINT);
} else {
    echo json_encode($form->errors(), JSON_PRETTY_PRINT);
}

$data = [
    "email" => "demis@gmail.com",
    "password" => "secrete24"
];

$loginFrom = new LoginFormRequest();
if ($loginFrom->validate($data))
    echo json_encode($loginFrom->validData(), JSON_PRETTY_PRINT);
else
    echo json_encode($loginFrom->errors(), JSON_PRETTY_PRINT);
