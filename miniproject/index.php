<?php

declare(strict_types=1);

session_start();
require_once __DIR__ . "/utils/utils.php";
const BASE_PATH = __DIR__ . "/";

require_once getBasePath("Http/route.php");
require_once getBasePath("Http/Session.php");
$path = $_SERVER['REQUEST_URI'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

route()->resolve(path: $path, method: $method);

Session::unflash();