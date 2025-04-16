<?php

declare(strict_types=1);

require_once __DIR__ . "/utils/utils.php";
const BASE_PATH = __DIR__ . "/";


require_once getBasePath("Http/route.php");
require_once getBasePath("Http/Router.php");
require_once getBasePath("Http/RequestMethod.php");


//$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$url = parse_url($_SERVER['REQUEST_URI'])['path'];

//print_r($url);


$path = route($url);
$router = new Router();
$router->route($path, RequestMethod::METHOD_GET);
