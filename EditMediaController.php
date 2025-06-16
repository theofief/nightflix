<?php
require_once "MediaController.php";

$mediaController = new MediaController();

$titre = $_POST['titre'] ?? '';
$date = $_POST['date'] ?? '';
$duree = intval($_POST['duree'] ?? 0);
$genre = $_POST['genre'] ?? '';
$realisateur = $_POST['realisateur'] ?? '';
$note = intval($_POST['note'] ?? 0);
$description = $_POST['description'] ?? '';
$affiche = $_POST['affiche'] ?? '';
$lien_media = $_POST['lien_media'] ?? '';
$lien_bande_annonce = $_POST['lien_bande_annonce'] ?? '';

// Vérifie que le film existe bien
if (!$titre || !$mediaController->mediaExists($titre)) {
    header("Location: editMedia.php?titre=" . urlencode($titre) . "&error=notfound");
    exit();
}

// Récupère les données actuelles du média pour récupérer les commentaires
$existingMedia = $mediaController->getMediaByTitle($titre);

if (!$existingMedia) {
    header("Location: editMedia.php?titre=" . urlencode($titre) . "&error=notfound");
    exit();
}

// Decode les commentaires JSON en tableau
$commentairesJson = $existingMedia['commentaires'] ?? '[]';
$commentaires = json_decode($commentairesJson, true);

if (!is_array($commentaires)) {
    $commentaires = [];
}

// Met à jour les données sans toucher aux commentaires
try {
    $mediaController->updateMediaDirectly(
        $titre,
        $date,
        $duree,
        $genre,
        $realisateur,
        $note,
        $description,
        $affiche,
        $lien_media,
        $lien_bande_annonce,
        $commentaires
    );
    header("Location: editMedia.php?titre=" . urlencode($titre) . "&success=1");
    exit();
} catch (Exception $e) {
    // Gestion simple d'erreur, tu peux faire mieux selon ton besoin
    header("Location: editMedia.php?titre=" . urlencode($titre) . "&error=updatefail");
    exit();
}