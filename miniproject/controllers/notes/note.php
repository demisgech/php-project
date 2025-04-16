<?php

declare(strict_types=1);

require_once getBasePath("app/getDBConnection.php");

require_once getBasePath("Http/HTTPStatusCode.php");

$currentAuthorizedUserId = 1;
try {

    $db = getDBConnection();
    global $note;

    if ($_SERVER['REQUEST_METHOD'] === "POST") {

        $sql = <<<SQL
            SELECT * FROM notes
            WHERE id = :id;
        SQL;
        $note = $db->query($sql, ['id' => $_GET['id']])->find();

        if (!$note) {
            abort();
        }

        authorize($note['user_id'] === $currentAuthorizedUserId);

        $db->query("DELETE FROM notes WHERE id = :id", ["id" => $_POST['id']]);
        echo "Successfully deleted";

        header("location: /notes");
        exit();

    } else {

        $sql = <<<SQL
            SELECT * FROM notes
            WHERE id = :id;
        SQL;
        $note = $db->query($sql, ['id' => $_GET['id']])->find();

        if (!$note) {
            abort();
        }

        authorize($note['user_id'] === $currentAuthorizedUserId);

    }
    $db->closeDatabaseInstance();

} catch (PDOException $ex) {
    echo $ex->getMessage();
}

view("notes/note.view.php");