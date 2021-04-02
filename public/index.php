<?php
require_once(__DIR__ . '/../vendor/autoload.php');
?>
<!DOCTYPE html>
<html>

<head>
    <?php require_once(__DIR__ . '/../components/head.php'); ?>
</head>

<body>
    <?php require_once(__DIR__ . '/../components/nav.php'); ?>
    <section class="hero">
        <h1>portfolio.dev</h1>
        <h2 class="tagline">Show What You can Do</h2>
        <a class="button" href="/signup">Get Started</a>
    </section>
    <main>
        <hr>
        <h1>See an example portfolio</h1>
        <a href="/portfolio/user0" class="button">Click Me!</a>
    </main>
    <section class="hero">
        <h4>
            <?php
            // NOTE maximum password length imposed by bcrypt is 72 characters
            $password_hash = password_hash("user0", PASSWORD_DEFAULT);
            $bad_hash = password_hash("user1", PASSWORD_DEFAULT);
            $password_result = password_verify("password", $password_hash);
            $password_bad_result = password_verify("bad", $password_hash);
            ?>
            </h4>
    </section>
</body>

</html>