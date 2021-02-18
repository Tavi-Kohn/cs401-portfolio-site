<?php
require_once(__DIR__ . '/vendor/autoload.php');
?>
<!DOCTYPE html>
<html>

<head>
    <?php require_once(__DIR__ . '/components/head.php'); ?>
    <link href="/styles/login.css" rel="stylesheet">
</head>

<body>
    <?php require_once(__DIR__ . '/components/nav.php'); ?>
    <main>
        <section class="auth">
            <form action="/auth.php" method="post">
                <h1>Sign Up</h1>
                <div>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">

                </div>
                <div>
                    <label for="password_conf">Confirm Password</label>
                    <input type="password" name="password_conf" id="password_conf">
                </div>
                <button type="submit" class="button">Submit</button>
            </form>
        </section>
    </main>
</body>

</html>