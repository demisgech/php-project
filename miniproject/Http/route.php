<?php

declare(strict_types=1);

require_once("Router.php");

require_once getBasePath("Http/Router.php");

function route(): Router
{

    $router = new Router();
    $router->get("/", "controllers/index.php");
    $router->get("/about", "controllers/about.php");
    $router->get("/contact", "controllers/contact.php");

    $router->get("/notes", "controllers/notes/all-notes.php")->only("auth");
    $router->get("/notes/create", "controllers/notes/new-note.php")->only('auth');
    $router->get("/note", "controllers/notes/note.php")->only('auth');
    $router->get("/note/edit", "controllers/notes/edit-note.php")->only('auth');
    $router->post("/notes/create", "controllers/notes/new-note.php")->only("auth");
    $router->patch("/note", "controllers/notes/update-note.php")->only('auth');
    $router->delete("/note", "controllers/notes/delete-note.php")->only('auth');

    $router->get("/register", "controllers/register/create.php")->only("guest");
    $router->post("/register", "controllers/register/signup.php")->only("guest");

    $router->get("/login", "controllers/session/create.php")->only("guest");
    $router->post("/session", "controllers/session/login.php")->only('guest');
    $router->delete("/session", "controllers/session/logout.php");

    return $router;
}


