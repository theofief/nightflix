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
$commentaires = [];

if ($mediaController->mediaExists($titre)) {
    // Film existe déjà -> erreur
    header("Location: addMedia.php?error=exists");
    exit();
}

// Sinon on ajoute le film
$mediaController->addMediaDirectly(
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

// Redirection avec succès
header("Location: addMedia.php?success=1");
exit();