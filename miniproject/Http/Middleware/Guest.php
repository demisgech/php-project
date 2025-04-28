<?php

declare(strict_types=1);

require_once "Redirect.php";

class Guest
{
    public function handle(): void
    {
        if (($_SESSION['user'] ?? false)) {
            Redirect::to("/");
        }
    }
}
