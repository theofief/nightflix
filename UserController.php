<?php

class UserController
{
    private PDO $db;

    public function __construct()
    {
        $host = "127.0.0.1";
        $dbName = "nightflix";
        $port = 8889;
        $userName = "root";
        $password = "root";
        try {
            $this->setDb(new PDO("mysql:host=$host;dbname=$dbName;port=$port;charset=utf8mb4", $userName, $password));
        } catch (PDOException $error) {
            echo "<p style='color:red'>{$error->getMessage()}</p>";
        }
    }

    public function setDb(PDO $db): void
    {
        $this->db = $db;
    }

    public function createUser(User $user): void
    {
        $req = $this->db->prepare("INSERT INTO `users` (name, email, password) VALUES (:name, :email, :password)");

        $req->bindValue(":name", $user->getName(), PDO::PARAM_STR);
        $req->bindValue(":email", $user->getEmail(), PDO::PARAM_STR);
        $req->bindValue(":password", $user->getPassword(), PDO::PARAM_STR);

        $req->execute();
    }

    public function updateUser(): void {}

    public function deleteUser(int $id): void
    {
        $req = $this->db->prepare("DELETE FROM `users` WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();
    }

    public function readUser(): void {}

    public function readAllUser(): array
    {
        $users = [];
        $req = $this->db->prepare("SELECT * FROM `users`");
        $req->execute();
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $users[] = new User($data);
        }
        return $users;
    }

    public function getUserByEmail(string $email): ?User
    {
        $req = $this->db->prepare("SELECT * FROM `users` WHERE email = :email");
        $req->bindValue(":email", $email, PDO::PARAM_STR);
        $req->execute();
        $data = $req->fetch();
        return $data ? new User($data) : null;
    }

    public function deleteUserByEmail(string $email): void
    {
        $req = $this->db->prepare("DELETE FROM `users` WHERE email = :email");
        $req->bindValue(":email", $email, PDO::PARAM_STR);
        $req->execute();
    }
}
