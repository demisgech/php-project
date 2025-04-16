<?php

spl_autoload_register(function ($className) {
    $file = __DIR__ . "/" . $className . ".php";

    if (file_exists($file)):
        require_once $file;
    else:
        die("$className is not found!!!");
    endif;
});