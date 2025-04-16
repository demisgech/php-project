<?php

declare(strict_types=1);

global $notes;

view("header.php");
?>
    <div>
        <h1 class="text-secondary text-center">Notes page</h1>
        <div class="p-5 m-5">
            <ul class="list-group">
                <?php foreach ($notes as $note) : ?>
                    <li class="list-group-item">
                        <a class="linke" href="/note?id=<?= $note['id'] ?>">
                            <?= htmlspecialchars($note['body'], HTML_ENTITIES) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="mt-5">
                <a href="notes/create" class="btn btn-primary"> Create Note</a>
            </div>
        </div>
    </div>
<?php

view("footer.php");

?>