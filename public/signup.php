<?php
require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/../util/session.php');
$session = new Session();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($session->signup($_POST["username"], $_POST["password"], $_POST["password_conf"])) {
        if ($session->login($_POST["username"], $_POST["password"])) {
            header("Location: /edit");
            exit();
        }
    }
}

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
            <form action="/signup" method="post">
                <h1>Sign Up</h1>
                <div class="warning">
                    <?php
                    foreach ($session->signupErrors() as $error) {
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
                <div>
                    <label for="password_conf">Confirm Password</label>
                    <input type="password" name="password_conf" id="password_conf">
                </div>
                <button type="submit" class="button">Sign Up</button>
            </form>
        </section>
    </main>
</body>

</html>