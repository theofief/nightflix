<?php
require_once "MediaController.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titre = $_POST['titre'] ?? '';
    $utilisateur = $_POST['utilisateur'] ?? '';
    $note = (int) ($_POST['note'] ?? 0);
    $texte = $_POST['texte'] ?? '';

    if ($titre && $utilisateur && $texte) {
        try {
            $controller = new MediaController();
            $controller->addCommentToMedia($titre, [
                "note" => $note,
                "texte" => $texte,
                "utilisateur" => $utilisateur
            ]);
            // Redirection vers watch.php avec le bon media et confirmation
            header("Location: http://127.0.0.1:8888/Projet/watch.php?media=" . urlencode($titre) . "&posted=1");
            exit;
        } catch (Exception $e) {
            // Redirection vers watch.php avec erreur
            header("Location: http://127.0.0.1:8888/Projet/watch.php?media=" . urlencode($titre) . "&error=" . urlencode($e->getMessage()));
            exit;
        }
    } else {
        // Redirection si champs manquants
        header("Location: http://127.0.0.1:8888/Projet/watch.php?media=" . urlencode($titre) . "&error=Tous les champs doivent être remplis");
        exit;
    }
}
?>