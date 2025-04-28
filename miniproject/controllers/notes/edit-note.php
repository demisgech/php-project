<?php

declare(strict_types=1);

require_once getBasePath("app/getDBConnection.php");
require_once getBasePath("Http/Validator.php");
$currentAuthorizedUserId = 1;

global $note;

try {
    $db = getDBConnection();

    $sql = <<<SQL
            SELECT * FROM notes
            WHERE id = :id;
        SQL;

    $note = $db->query($sql, ['id' => $_GET['id']])->findOrFail();

    authorize($note['user_id'] === $currentAuthorizedUserId);

    $db->closeDatabaseInstance();

} catch (PDOException $ex) {
    echo $ex->getMessage();
}


view("notes/edit-note.view.php");