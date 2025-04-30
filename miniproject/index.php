<?php

declare(strict_types=1);

session_start();
require_once __DIR__ . "/utils/utils.php";
const BASE_PATH = __DIR__ . "/";

require_once getBasePath("Http/route.php");
require_once getBasePath("Http/Session.php");
require_once getBasePath("Controllers/forms/FormValidationException.php");

$path = $_SERVER['REQUEST_URI'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    route()->resolve(path: $path, method: $method);
} catch (FormValidationException $ex) {
    Session::flash('errors', $ex->getErrors());
    Session::flash('old', $ex->getStaileData());
    redirect(route()->previousUrl());
}

Session::unflash();