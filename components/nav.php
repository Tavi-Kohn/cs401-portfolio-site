<nav>
    <a href="/" class="brand">
        <div class="logo"><?php echo file_get_contents('./images/heroku.svg') ?></div>
        <h1>Simple Portfolio Hosting</h1>
    </a>
    <?php
    require_once(__DIR__ . "/../util/session.php");
    require_once(__DIR__ . "/../templates/logout_button.php");
    require_once(__DIR__ . "/../templates/login_button.php");
    $session = new Session();
    if ($session->loggedIn()) {
        $username = $session->username();
        echo ("<div>Welcome $username!</div>");
        echo (LogoutButton::render());
    } else {
        echo (LoginButton::Render());
    }
    ?>
</nav>