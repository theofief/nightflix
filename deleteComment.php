<?php
session_start();

function is_connected(): bool
{
    return isset($_SESSION['email']) && isset($_SESSION['name']);
}

if (!is_connected()) {
    header("Location: /login.php");
    exit;
}

require_once "MediaController.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['media'], $_POST['index'])) {
    $titre = $_POST['media'];
    $index = (int) $_POST['index'];

    try {
        $controller = new MediaController();
        $controller->deleteCommentFromMedia($titre, $index);

        // Redirection avec le bon paramètre GET
        header("Location: /Projet/watch.php?media=" . urlencode($titre));
        exit;
    } catch (Exception $e) {
        echo "Erreur lors de la suppression du commentaire : " . htmlspecialchars($e->getMessage());
    }
} else {
    echo "Requête invalide ou paramètres manquants.";
}