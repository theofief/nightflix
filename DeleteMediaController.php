<?php
require_once "MediaController.php";

$titre = $_POST['titre'] ?? '';

$mediaController = new MediaController();

if ($mediaController->deleteMediaByTitleIfExists($titre)) {
    // Suppression OK, on redirige avec un message de succès
    header("Location: deleteMedia.php?success=1");
    exit();
} else {
    // Film pas trouvé, on redirige avec un message d’erreur
    header("Location: deleteMedia.php?error=notfound");
    exit();
}