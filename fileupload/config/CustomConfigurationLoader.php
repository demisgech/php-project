<?php

declare(strict_types=1);

// Load the .env file
//    require_once "loadEnv.php";
//    loadEnv(__DIR__ . '/.env');
    loadEnv(__DIR__ . '/.config');
    echo $_ENV['HOST'];


    require_once 'loadEnv.php';

    // Load the .config file
    loadEnv(__DIR__ . '/.config');

    // Access the values
    $appName = $_ENV['APP_NAME'] ?? 'DefaultApp';
    $uploadPath = $_ENV['UPLOAD_PATH'] ?? 'uploads';
    $maxSize = (int) ($_ENV['UPLOAD_MAX_SIZE'] ?? 2_000_000);

    echo "App: $appName\n";
    echo "Upload path: $uploadPath\n";
    echo "Max size: $maxSize\n";
