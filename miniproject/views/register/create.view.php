<?php


declare(strict_types=1);
// Redirect
//if ($_SESSION['user'] ?? false) {
//    header("location:/");
//    exit();
//}

view("header.php");

require_once "registration-form.php";

view("footer.php");
