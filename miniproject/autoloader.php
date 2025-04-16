<?php

spl_autoload_register(function ($fileName) {
    $paths = [
        __DIR__ . "/",
        __DIR__ . "/app/",
        __DIR__ . "/controllers/",
        __DIR__ . "/views/",

    ];

    foreach ($paths as $path) {
        $filePath = $path . str_replace("\\", DIRECTORY_SEPARATOR, $fileName) . ".php";
        $fileName = getBasePath($filePath);
        echo $filePath;

        if (file_exists($filePath)):
            require_once $filePath;
        else:
            die("$fileName is not found!!!");
        endif;
    }
});
