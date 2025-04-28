<?php

declare(strict_types=1);

require_once "controllers/forms/Authenticator.php";

Authenticator::logout();

redirect("/");
