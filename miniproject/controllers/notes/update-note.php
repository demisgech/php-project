<?php

declare(strict_types=1);

require_once getBasePath("app/getDBConnection.php");
require_once getBasePath("Http/Validator.php");

$currentAuthorizedUserId = 1;

try {
    $db = getDBConnection();
    $sql = <<<SQL
            SELECT * FROM notes
            WHERE id = :id;
        SQL;
    global $note, $errors;
    $note = $db->query($sql, ['id' => $_POST['id']])->findOrFail();

    $errors = [];
    if (!Validator::validateString($_POST['body'], 5, 1000)) {
        $errors['body'] = "This field is required with a minimum of 5 characters and a maximum of 1000 characters";
    }

    authorize($note['user_id'] === $currentAuthorizedUserId);

    if (count($errors)) {
        return view("notes/edit-note.view.php");
    }

    $sql = <<<SQL
                UPDATE notes SET body = :body
                WHERE id = :id AND user_id = :user_id;
             SQL;
    $db->query($sql, ['body' => $_POST['body'], 'id' => $_POST['id'], "user_id" => 1]);

    $db->closeDatabaseInstance();
    header("location: /notes");
    die();

} catch (RuntimeException $ex) {
    echo $ex->getMessage();
}