<?php
require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/../util/session.php');
$session = new Session();
?>
<!DOCTYPE html>
<html>

<head>
    <?php require_once(__DIR__ . '/../components/head.php'); ?>
    <link href="/styles/auth.css" rel="stylesheet">
</head>

<body>
    <?php require_once(__DIR__ . '/../components/nav.php'); ?>
    <main>
        <section class="auth">
            <form action="/auth" method="post">
                <h1>Log In</h1>
                <div class="warning">
                    <?php
                    foreach ($session->loginErrors() as $error) {
                        echo ("<p>$error</p>");
                    }
                    ?>
                </div>
                <div>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                </div>
                <button type="submit" class="button">Log In</button>
            </form>
        </section>
    </main>
</body>

</html>