<?php
require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/../templates/edit_project.php');
require_once(__DIR__ . '/../util/session.php');

$session = new Session();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $count = intval($_POST["count"]);
    $projects = [];
    for ($i = 0; $i < $count; $i++) {
        $name = $_POST["project_name_" . $i + 1];
        $description = $_POST["project_description_" . $i + 1];
        if ($name !== "" && $description !== "") {
            array_push($projects, [$name, $description]);
        }
    }
    if ($session->updateProjects($projects)) {
        header("Location: /portfolio/" . $session->username());
        exit();
    }
    header("Location: /login");
    exit();
}

if (!$session->loggedIn()) {
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
                <input type="hidden" , name="count" value="<?php echo (count($session->projects()) + 1) ?>">
                <?php
                $i = 1;
                foreach ($session->projects() as $project) {
                    echo EditProject::render($i++, $project["name"], $project["description"]);
                }
                echo EditProject::render($i);
                ?>
                <button type="submit" class="button">Update</button>
            </form>
        </section>
    </main>
</body>

</html>