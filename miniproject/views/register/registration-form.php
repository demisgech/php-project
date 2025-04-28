<?php
require_once "utils/utils.php";
?>

<div class="container m-auto row justify-content-center mt-3">
    <div class="m-auto align-items-center w-50 justify-content-center border border-primary rounded rounded-3 p-4">
        <form action="/register" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label" for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control"/>
            </div>
            <?php showError("username") ?>
            <div class="mb-3">
                <label class="form-label" for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control"/>
            </div>
            <?php showError("first_name") ?>
            <div class="mb-3">
                <label class="form-label" for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control"/>
            </div>
            <?php showError("last_name") ?>
            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control"/>
            </div>
            <?php showError("email") ?>
            <div class="mb-3">
                <label class="form-label" for="password">password</label>
                <input type="password" name="password" id="password" class="form-control"/>
            </div>
            <?php showError("password") ?>
            <?php if (count($GLOBALS['errors'] ?? []) === 0) : ?>
                <p class="text-success">Successfully registered!!!</p>
            <?php endif; ?>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary" name="submit">Register</button>
            </div>
        </form>
    </div>
</div>