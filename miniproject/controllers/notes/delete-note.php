<?php

declare(strict_types=1);

require_once getBasePath("app/getDBConnection.php");

require_once getBasePath("Http/HTTPStatusCode.php");

$currentAuthorizedUserId = 1;
try {

    $db = getDBConnection();

    $sql = <<<SQL
            SELECT * FROM notes
            WHERE id = :id;
        SQL;

    global $note;
    $note = $db->query($sql, ['id' => $_GET['id']])->findOrFail();

    authorize($note['user_id'] === $currentAuthorizedUserId);

    $db->query("DELETE FROM notes WHERE id = :id", ["id" => $_POST['id']]);

    //    echo "Successfully deleted";

    $db->closeDatabaseInstance();

    header("location: /notes");
    exit();


} catch (PDOException $ex) {
    echo $ex->getMessage();
}

view("notes/note.view.php");