<?php
require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/../templates/edit_project.php');
require_once(__DIR__ . '/../util/session.php');

$session = new Session();

if($_SERVER["REQUEST_METHOD"] === "POST") {
    header("Location: /login");
    exit();
}

if(!$session->loggedIn()) {
    header("Location: /login");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <?php require_once(__DIR__ . '/../components/head.php'); ?>
    <link href="/styles/edit.css" rel="stylesheet">
</head>

<body>
    <?php require_once(__DIR__ . '/../components/nav.php'); ?>
    <main>
        <section class="edit">
            <form action="/edit" method="post">
                <h1>Edit Profile</h1>
                <?php
                    $i = 1;
                    foreach($session->projects() as $project) {
                        echo EditProject::render($i++);
                    }
                    echo EditProject::render($i);
                ?>
                <button type="submit" class="button">Log In</button>
            </form>
        </section>
    </main>
</body>

</html>