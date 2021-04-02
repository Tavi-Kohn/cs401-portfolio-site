<?php
require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/../util/db.php');
require_once(__DIR__ . '/../util/session.php');

$user_username = $_POST['username'] ?? null;
$user_password = $_POST['password'] ?? null;
$session = new Session();
$authorized = $session->login($user_username, $user_password);

if($authorized === true) {
    header("Location: /edit");
    exit();
} else {
    header("Location: /login");
    exit();
}
?>