<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "MailController.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';

    if (!empty($email)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: http://127.0.0.1:8888/Projet/index.php?error=" . urlencode("Email invalide"));
            exit;
        }

        try {
            $newsletterController = new MailController();
            $newsletterController->addMail($email);

            // ✅ Redirection si tout s'est bien passé
            header("Location: http://127.0.0.1:8888/Projet/index.php?subscribed=" . urlencode("Merci pour votre inscription à la newsletter ✅"));
            exit;
        } catch (Exception $e) {
            // 🔥 Affiche l'erreur dans l'URL
            $errorMessage = $e->getMessage();
            header("Location: http://127.0.0.1:8888/Projet/index.php?error=" . urlencode("Erreur : " . $errorMessage));
            exit;
        }
    } else {
        header("Location: http://127.0.0.1:8888/Projet/index.php?error=" . urlencode("Adresse email manquante"));
        exit;
    }
}
?>