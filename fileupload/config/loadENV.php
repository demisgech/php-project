<?php

declare(strict_types=1);

function loadEnv(string $path = ".env") {
    if(!file_exists($path)) return;

    $lines =  file($path,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach($lines as $line) {
        // skip comments
        if(str_starts_with(trim($line),"#")) continue;

        // unpacking
        [$key,$value] = explode("=",$line,2);

        $key = trim($key);
        $value = trim($value);

        $value = trim($value,"\"'");
        putenv("$key=$value");
        $_ENV[$key]=$value;
    }
}