<?php

declare(strict_types=1);


class FileLogger implements Logger
{
    public function log(string $message): void
    {
        echo "[FileLoger]: $message \n";
    }
}