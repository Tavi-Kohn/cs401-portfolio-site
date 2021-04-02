<?php
require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/../util/session.php');
$session = new Session();
$session->destroy();
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
        <section>
            <h1>You have been logged out</h1>
        </section>
            
    </main>
</body>

</html>