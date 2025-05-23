<?php

declare(strict_types=1);

view("header.php");

?>
    <main>
        <div class="container">
            <h1 class="text-muted">Create note</h1>
            <div class="container">
                <form method="POST">
                    <div class="mb-3">
                        <label for="body" class="form-label">Notes</label>
                        <textarea id="body" type="text" class="form-control" name="body"
                                  placeholder="Here's an idea to create a note..."></textarea>
                    </div>
                    <?php if (array_key_exists('errors', $GLOBALS)) : ?>
                        <?php if (isset($GLOBALS['errors']['body'])): ?>
                            <div class="mb-3">
                                <p class="text-danger"><?= $GLOBALS['errors']['body'] ?></p>
                            </div>
                        <?php else: ?>
                            <p class="text-success">Note Successfully Created!!!</p>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
<?php

view("footer.php");

?>