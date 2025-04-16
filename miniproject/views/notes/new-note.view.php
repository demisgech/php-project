<?php

declare(strict_types=1);

view("header.php");

?>

    <main>
        <div class="container">
            <h1 class="text-muted">Create note</h1>
            <?php require_once "note-form.php" ?>
        </div>
    </main>

<?php

view("footer.php");

?>