<?php

declare(strict_types=1);

class FileUploadService
{
    private Storage $storage;
    private int $maxSize;
    private array $allowedExtensions;

    public function __construct(
        Storage $storage,
        int     $maxSize = 5_000_000, // 5MB
        array   $allowedExtensions = ['jpg', 'gif', 'png', 'jpeg']

    )
    {
        $this->storage = $storage;
        $this->maxSize = $maxSize;
        $this->allowedExtensions = $allowedExtensions;
    }

    /**
     * @throws Exception
     */
    public function upload(UploadFile $file): string
    {
        // 5MB
        if ($file->getSize() > $this->maxSize) {
            throw new Exception("File size is too large!!");
        }

        if (!in_array(strtolower($file->getExtension()), $this->allowedExtensions))
            throw new Exception("Invalid file extension");

        return $this->storage->store("uploads", $file);
    }
}