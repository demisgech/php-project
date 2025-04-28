<?php

declare(strict_types=1);

view("header.php");

global $note;

?>
    <div class="m-3">
        <p class="text-muted"> <?= $note['body'] ?> </p>
        <form action="#" method="POST">
            <input type="hidden" name="_method" value="DELETE"/>
            <input type="hidden" name="id" value="<?= $note['id'] ?>"/>
            <div class="mb-3">
                <button class="btn btn-danger">Delete</button>
                <a class="btn btn-secondary ms-3" href="/note/edit?id=<?= $note['id'] ?>">
                    Edit
                </a>
            </div>
        </form>
    </div>
<?php

view("footer.php");