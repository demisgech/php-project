<?php

declare(strict_types=1);

function route(string $url)
{
    return match ($url) {
        "", "/" => getBasePath("controllers/index.php"),
        "/about" => getBasePath("controllers/about.php"),
        "/contact" => getBasePath("controllers/contact.php"),
        "/login" => getBasePath("controllers/login.php"),
        "/notes" => getBasePath("controllers/notes/all-notes.php"),
        "/notes/create" => getBasePath("controllers/notes/new-note.php"),
        "/note" => getBasePath("controllers/notes/note.php"),
        default => abort()
    };
}
