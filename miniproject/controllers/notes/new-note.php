<?php

declare(strict_types=1);


require_once getBasePath("app/getDBConnection.php");
require_once getBasePath("Http/Validator.php");

try {

    $db = getDBConnection();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $errors = [];
        if (!Validator::validateString($_POST['body'], 5, 1000)) {
            $errors['body'] = "This field is required with a minimum of 5 characters and a maximum of 1000 characters";
        }

        if (empty($errors)) {
            $sql = <<<SQL
                    INSERT INTO notes (body, user_id)
                    VALUES ( :body, :user_id);
                 SQL;
            $db->query($sql, ['body' => $_POST['body'], "user_id" => 1]);
        }
    }

    $db->closeDatabaseInstance();
} catch (PDOException $ex) {
    echo $ex->getMessage();
}


view("notes/new-note.view.php");