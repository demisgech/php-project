<?php

declare(strict_types=1);

view("header.php");

global $note;

?>
    <div class="m-3">
        <p class="text-muted"> <?= $note['body'] ?> </p>
        <form action="#" method="post">
            <input type="hidden" name="id" value="<?= $note['id'] ?>"/>
            <button class="btn btn-danger">Delete</button>
        </form>
    </div>
<?php

view("footer.php");