<?php
require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/db.php');

/**
 * Interface to the $_SESSION superglobal and DAO class
 */
class Session
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_name("session");
            session_start();
            if (!isset($_SESSION["login_errors"])) {
                $_SESSION["login_errors"] = [];
            }
            if (!isset($_SESSION["login_errors"])) {
                $_SESSION["signup_errors"] = [];
            }
            if (!isset($_SESSION["username"])) {
                $_SESSION["username"] = NULL;
            }
        }
    }

    public function destroy(): void
    {
        session_destroy();
    }

    public function login(String $username, String $password): bool
    {
        $dao = new DAO();
        $authorized = $dao->authUser($username, $password);
        if ($authorized) {
            $_SESSION["username"] = $username;
            $_SESSION["login_errors"] = [];
            $_SESSION["signup_errors"] = [];
        } else {
            $_SESSION["login_errors"] = ["Username or password incorrect"];
            $_SESSION["username"] = NULL;
        }

        return $authorized;
    }

    public function signup(String $username, String $password, String $password_confirmation): bool
    {
        $_SESSION["signup_errors"] = [];
        if (strlen($username) < 3) {
            array_push($_SESSION["signup_errors"], "Username must be at least 3 characters long");
            return false;
        }

        if (strlen($password) < 8) {
            array_push($_SESSION["signup_errors"], "Password must be at least 8 characters long");
            return false;
        }

        if (strcmp($password, $password_confirmation) !== 0) {
            array_push($_SESSION["signup_errors"], "Passwords must match exactly");
            return false;
        }
        $dao = new DAO();
        if ($dao->userExists($username)) {
            array_push($_SESSION["signup_errors"], "Username not available");
            return false;
        }
        $dao->addUser($username, $password);
        // NOTE this may be somewhat excessive, as user creation is a transaction, but it does ensure that the user was created correctly
        return $dao->userExists($username);
    }

    public function username(): ?String
    {
        return $_SESSION["username"];
    }

    public function projects(): array
    {
        $dao = new DAO();
        return $dao->getProjects($this->username());
    }

    public function loginErrors(): array
    {
        return $_SESSION["login_errors"] ?? [];
    }

    public function signupErrors(): array
    {
        return $_SESSION["signup_errors"] ?? [];
    }

    public function loggedIn(): bool
    {
        if (isset($_SESSION["username"])) {
            return !is_null($_SESSION["username"]);
        }
        return false;
    }

    public function updateProjects(array $projects): bool
    {
        $dao = new DAO();
        if ($this->loggedIn()) {
            foreach ($projects as $project) {
                if(count($project) != 2) {
                    return false;
                }
            }
            $dao->updateProjects($this->username(), $projects);
            return true;
        }
        return false;
    }
}
