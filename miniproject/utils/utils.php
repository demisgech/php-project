<?php

declare(strict_types=1);

require_once "Http/HTTPStatusCode.php";
require_once "Http/Session.php";
function abort(int $statusCode = 404): never
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

function redirect(string $path): never
{
    header("Location: $path");
    exit();
}

function showError(string $name): void
{
    if (array_key_exists('_flashed', $_SESSION)) :
        if (isset(Session::get('errors')["$name"])): ?>
            <div class="mb-3">
                <p class="text-danger"><?= Session::get('errors')["$name"] ?></p>
            </div>
        <?php endif;
    endif;
}

