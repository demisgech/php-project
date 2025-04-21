<?php

declare(strict_types=1);

spl_autoload_register(function ($className) {
    $file = __DIR__ . "/$className.php";
    if (file_exists($file))
        require_once $file;
    else
        die("$file is not found!!");
});

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_FILES['file'])) {
    $file = new UploadFile($_FILES['file']);
    $fileSystem = new LocalFileSystem();
    $storage = new LocalStorage($fileSystem);
    $service = new FileUploadService($storage);
    try {
        $path = $service->upload($file);
        echo "File uploaded on: $path";
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}