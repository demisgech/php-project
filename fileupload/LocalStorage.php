<?php

declare(strict_types=1);

class LocalStorage implements Storage
{
    private FileSystem $fileSystem;

    public function __construct(FileSystem $fileSystem)
    {
        $this->fileSystem = $fileSystem;
    }

    /**
     * @throws Exception
     */
    public function store(string $path, UploadFile $file): string
    {
        $fileName = uniqid("", true) . "_" . $file->getOriginalName();
        $destination = rtrim($path, "/") . "/" . $fileName;
        if (!$this->fileSystem->put($destination, $file->getTemporaryName())) {
            throw new Exception("Failed to store file!!");
        }
        return $destination;
    }
}