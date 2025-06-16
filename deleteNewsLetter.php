<?php
require_once "MailController.php";

// Tu peux ajouter un check is_connected() ici aussi
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['mail'])) {
    $mail = $_POST['mail'];

    $newsletterController = new MailController();

    try {
        $newsletterController->deleteMail($mail);
        header("Location: newsLetterList.php?success=" . urlencode("Email supprimé"));
        exit;
    } catch (Exception $e) {
        header("Location: newsLetterList.php?error=" . urlencode("Erreur : " . $e->getMessage()));
        exit;
    }
} else {
    header("Location: newsLetterList.php?error=" . urlencode("Mail manquant"));
    exit;
}