<?php

spl_autoload_register(function ($fileName) {
    $file = __DIR__ . "/" . $fileName . ".php";

    if (file_exists($file)):
        require_once $file;
    else:
        die("$fileName is not found!!!");
    endif;
});
