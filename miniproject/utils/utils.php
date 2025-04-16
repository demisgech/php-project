<?php

declare(strict_types=1);

function abort(int $statusCode = 404)
{
    http_response_code($statusCode);

    view("$statusCode.view.php");
    die();
}

function authorize(bool $condition, int $statusCode = HTTPStatusCode::HTTP_403_FORBIDDEN): void
{
    if (!$condition)
        abort($statusCode);
}


function view(string $path)
{
    return require_once getBasePath("views/$path");
}

function getBasePath(string $path): string
{
    return BASE_PATH . "$path";
}

function sanitize(string $data): string
{
    $result = trim($data);
    $result = htmlspecialchars($result);
    $result = strip_tags($result);
    return stripslashes($result);
}