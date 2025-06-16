<?php
class MailController
{
    private PDO $db;

    public function __construct()
    {
        $dbName = "nightflix"; // ✅ ici !
        $port = 8889;
        $userName = "root";
        $password = "root";

        try {
            $this->setDb(new PDO("mysql:host=127.0.0.1;dbname=$dbName;port=$port;charset=utf8mb4", $userName, $password));
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
            echo "<p style='color:red'>Erreur connexion DB : {$error->getMessage()}</p>";
            die("Impossible de se connecter à la base de données.");
        }
    }

    public function setDb(PDO $db): void
    {
        $this->db = $db;
    }

    public function addMail(string $email): void
    {
        $req = $this->db->prepare("SELECT COUNT(*) FROM newsletter WHERE mail = :email");
        $req->bindValue(":email", $email, PDO::PARAM_STR);
        $req->execute();

        if ($req->fetchColumn() > 0) {
            throw new Exception("Email déjà inscrit !");
        }
        $insert = $this->db->prepare("INSERT INTO newsletter (mail) VALUES (:email)");
        $insert->bindValue(":email", $email, PDO::PARAM_STR);
        $insert->execute();
    }

    public function getAllMails(): array
    {
        $query = $this->db->query("SELECT mail FROM newsletter");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteMail(string $mail): void
    {
        $stmt = $this->db->prepare("DELETE FROM newsletter WHERE mail = :mail");
        $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
        $stmt->execute();
    }
}
