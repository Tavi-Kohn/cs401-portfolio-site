<?php
require_once(__DIR__ . '/../vendor/autoload.php');

class DAO
{
    private PDO $pdo;
    public function __construct()
    {
        $db = parse_url(getenv("DATABASE_URL"));
        $db["port"] = $db["port"] ?? 5432;
        $db["path"] = ltrim($db["path"], "/");
        $this->pdo = new PDO("pgsql:host=$db[host];port=$db[port];user=$db[user];password=$db[pass];dbname=$db[path]");

        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->pdo->setAttribute(PDO::ATTR_TIMEOUT, 2);
    }

    public function getProjects(String $username): array
    {
        $statement = $this->pdo->prepare("select name, description, image_uri from projects join users on projects.user_id = users.id where users.username = :user_username");
        $statement->bindParam(":user_username", $username, PDO::PARAM_STR);
        if ($statement->execute()) {
            return $statement->fetchAll();
        }
        return [];
    }

    public function authUser(String $username, String $password): bool
    {
        $statement = $this->pdo->prepare("select hash from passwords join users on passwords.user_id = users.id where users.username = :user_username");
        $statement->bindParam(":user_username", $username, PDO::PARAM_STR);
        if ($statement->execute()) {
            $result = $statement->fetch();
            if (isset($result["hash"])) {
                $hash = $result["hash"];
                return password_verify($password, $hash);
            }
        }
        return false;
    }

    public function userExists(String $username): bool
    {
        $statement = $this->pdo->prepare("select exists (select 1 from users where users.username = :user_username)");
        $statement->bindParam(":user_username", $username, PDO::PARAM_STR);
        if ($statement->execute()) {
            return $statement->fetch()[0];
        } else {
            echo ("statement execute false");
        }
        return true;
    }

    public function addUser(String $username, String $password): void
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $add_user = $this->pdo->prepare("insert into users (username) values (:user_username) returning id");
        $add_user->bindParam(":user_username", $username, PDO::PARAM_STR);

        $add_password = $this->pdo->prepare("insert into passwords (user_id, hash) values (:user_id, :hash)");
        $add_password->bindParam(":hash", $hash, PDO::PARAM_STR);

        $this->pdo->beginTransaction();
        $add_user->execute();
        $user_id = $add_user->fetch()["id"];
        $add_password->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $add_password->execute();
        $this->pdo->commit();
    }

    public function updateProjects(String $username, array $projects): void
    {
        $get_user_id = $this->pdo->prepare("select id from users where username = :username");
        $get_user_id->bindParam(":username", $username, PDO::PARAM_STR);
        $get_user_id->execute();
        $user_id = $get_user_id->fetch()["id"];
        $delete_projects = $this->pdo->prepare("delete from projects where user_id = :user_id");
        $image_uri = "https://source.unsplash.com/random?programming";
        $delete_projects->bindParam(":user_id", $user_id, PDO::PARAM_INT);

        echo("Begin Transaction<br>");
        $this->pdo->beginTransaction();
        $delete_projects->execute();
        foreach ($projects as $project) {
            $project_name = $project[0];
            $project_desc = $project[1];
            var_dump($project_name);
            var_dump($project_desc);
            $create_projects = $this->pdo->prepare("insert into projects (user_id, name, description, image_uri) values (:user_id, :project_name, :description, :image_uri)");
            $create_projects->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $create_projects->bindParam(":project_name", $project_name, PDO::PARAM_STR);
            $create_projects->bindParam(":description", $project_desc, PDO::PARAM_STR);
            $create_projects->bindParam(":image_uri", $image_uri, PDO::PARAM_STR);
            $create_projects->execute();
        }
        echo("Commit Transaction<br>");
        $this->pdo->commit();
    }
}
