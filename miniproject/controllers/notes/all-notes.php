<?php

declare(strict_types=1);

require_once getBasePath("app/getDBConnection.php");

try {
    $db = getDBConnection();
    $statement = $db->query("SELECT * FROM notes");

    global $notes;
    $notes = $statement->fetchAll();

//    echo json_encode($notes, JSON_PRETTY_PRINT);

} catch (PDOException $ex) {
    echo $ex->getMessage();
}

view("notes/all-notes.view.php");