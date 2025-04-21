<?php

declare(strict_types=1);

interface Storage
{
    public function store(string $path, UploadFile $file): string;
}