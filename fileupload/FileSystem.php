<?php

declare(strict_types=1);

interface FileSystem
{
    public function put(string $path, string $temporaryFilePath): bool;
}