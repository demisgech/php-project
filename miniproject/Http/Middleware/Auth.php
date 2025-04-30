<?php

declare(strict_types=1);

require_once "Redirect.php";

class Auth
{
    public function handle(): void
    {
        if (!($_SESSION['user'] ?? false)) {
            //            http_response_code(401);
            Redirect::to("/");
        }
    }
}