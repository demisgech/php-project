<div class="container">
    <form method="POST">
        <div class="mb-3">
            <label for="body" class="form-label">Notes</label>
            <textarea id="body" type="text" class="form-control" name="body"
                      placeholder="Here's an idea to create a note..."><?= $_POST['body'] ?? '' ?></textarea>
        </div>
        <?php if (isset($errors['body'])): ?>
            <div class="mb-3">
                <p class="text-danger"><?= $errors['body'] ?></p>
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>