<?php

declare(strict_types=1);

class LocalFileSystem implements FileSystem
{
    public function put(string $path, string $temporaryFilePath): bool
    {
        $directory = dirname($path);
        if (!is_dir($directory))
            mkdir($directory, 0777, true);

        if (!is_uploaded_file($temporaryFilePath)) return false;

        return move_uploaded_file($temporaryFilePath, $path);
    }
}