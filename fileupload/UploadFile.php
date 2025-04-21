<?php

declare(strict_types=1);

// Data Transfer Object
class UploadFile
{
    private string $originalName;
    private string $temporaryName;
    private int $size;
    private string $mime;

    public function __construct(array $file)
    {
        if (!isset($file['tmp_name'], $file['name'], $file['size'], $file['type']))
            throw new InvalidArgumentException("Invalid file uplpad structure");
        $this->originalName = $file['name'];
        $this->temporaryName = $file['tmp_name'];
        $this->size = $file['size'];
        $this->mime = mime_content_type($file['tmp_name']);
    }

    public function isValidImage(): bool
    {
        return in_array($this->mime, ["image/gpeg", "image/jgp", "image/png", "image/gif", "image/webp"]);
    }

    public function getExtension(): string|array
    {
        return pathinfo($this->originalName, PATHINFO_EXTENSION);
    }

    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    public function getTemporaryName(): string
    {
        return $this->temporaryName;
    }

    public function getSize(): int
    {
        return $this->size;
    }
}