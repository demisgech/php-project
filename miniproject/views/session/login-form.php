<div class="container m-auto row justify-content-center mt-3">
    <div class="m-auto align-items-center w-50 justify-content-center border border-primary rounded rounded-3 p-4">
        <form action="/session" method="POST" enctype="multipart/form-data">
            <?php showError('login_failed') ?>
            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control"
                       value="<?= Session::old('email') ?? "" ?>"/>
            </div>
            <?php showError('email') ?>
            <div class="mb-3">
                <label class="form-label" for="password">password</label>
                <input type="password" name="password" id="password" class="form-control"/>
            </div>
            <?php showError('password') ?>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary" name="submit">Login</button>
            </div>
        </form>
    </div>
</div>