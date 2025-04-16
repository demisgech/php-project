<?php

declare(strict_types=1);


interface Logger
{
    public function log(string $message): void;
}