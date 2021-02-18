<?php
require_once(__DIR__ . '/vendor/autoload.php');
?>
<!DOCTYPE html>
<html>

<head>
    <?php require_once(__DIR__ . '/components/head.php'); ?>
</head>

<body>
<?php require_once(__DIR__ . '/components/nav.php'); ?>
    <section class="hero">
        <h1>portfolio.dev</h1>
        <h2 class="tagline">Show What You can Do</h2>
        <a class="button" href="/login.php">Get Started</a>
    </section>
    <main>
        <hr>
        <h1>See an example portfolio</h1>
        <a href="/portfolio.php" class="button">Click Me!</a>
    </main>
</body>

</html>