<?php

declare(strict_types=1);

view("header.php");

?>

    <main>
        <div class="container">
            <h1 class="text-muted">Edit note</h1>
            <div class="container">
                <form method="POST" action="/note">
                    <div class="mb-3">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="id" value="<?= $GLOBALS['note']['id'] ?>">
                        <label for="body" class="form-label">Notes</label>
                        <textarea id="body" type="text" class="form-control" name="body"
                                  placeholder="Here's an idea to create a note..."><?= $GLOBALS['note']['body'] ?? '' ?></textarea>
                    </div>
                    <?php if (array_key_exists('errors', $GLOBALS)) : ?>
                        <?php if (isset($GLOBALS['errors']['body'])): ?>
                            <div class="mb-3">
                                <p class="text-danger"><?= $GLOBALS['errors']['body'] ?></p>
                            </div>
                        <?php else: ?>
                            <p class="text-success">Note Updated Successfully!!!</p>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="mb-3">
                        <div class="w-100 flex-column align-items-end gap-3">
                            <a href="/notes" class="btn btn-secondary">Cancel</a>
                            <a href="/note?id=<?= $GLOBALS['note']['id'] ?>">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

<?php

view("footer.php");

?>