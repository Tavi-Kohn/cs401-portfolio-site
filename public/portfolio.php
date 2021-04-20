<?php
require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/../templates/project.php');
require_once(__DIR__ . '/../util/db.php');
require_once(__DIR__ . '/../util/log.php');
require_once(__DIR__ . '/../util/session.php');
$sesssion = new Session();
?>
<!DOCTYPE html>
<html>

<head>
    <?php require_once(__DIR__ . '/../components/head.php'); ?>
    <link href="/styles/project.css" rel="stylesheet">
</head>

<body>
    <main>
        <?php
        $user_username = $_GET['username'] ?? null;
        if ($user_username == null) {
            http_response_code(404);
            exit();
        }

        try {
            $dao = new DAO();
            $projects = $dao->getProjects($user_username);
            if (count($projects) == 0) {
                http_response_code(404);
                exit();
            }
            foreach ($projects as $project) {
                echo Project::render($project['name'], $project['description'], $project['image_uri']);
            }
            if ($user_username === $sesssion->username()) {
                require_once(__DIR__ . '/../components/edit_button.php');
            }
        } catch (PDOException $e) {
            get_logger()->warning($e->getMessage());
            get_logger()->warning($e->getTraceAsString());
            http_response_code(500);
            exit();
        }
        ?>
    </main>
</body>

</html>