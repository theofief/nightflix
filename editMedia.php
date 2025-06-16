<?php
require_once "header.php";

$titreRecherche = $_POST['titreRecherche'] ?? '';
$mediaData = null;
$error = null;

if ($titreRecherche !== '') {
    if ($mediaController->mediaExists($titreRecherche)) {
        $mediaData = $mediaController->getMediaByTitle($titreRecherche);
    } else {
        $error = "Le film \"$titreRecherche\" n'existe pas.";
    }
}
?>
<?php if (is_connected()): ?>
<?php else: ?>
    <script>
        window.location.href = "index.php";
    </script>
<?php endif ?>
<br/><br/><br/><br/><br/>

<button class="back" onclick="window.location.href='admin.php'"> < Retour</button>

<h1>Modifier un film</h1>

<!-- Formulaire de recherche -->
<form method="POST" action="">
    <label>Recherche par titre :</label>
    <input type="text" name="titreRecherche" value="<?= htmlspecialchars($titreRecherche) ?>" required />
    <button type="submit">Rechercher</button>
</form>

<?php if ($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<?php if ($mediaData): ?>
    <h2>Modifier le film : <?= htmlspecialchars($titreRecherche) ?></h2>

    <form action="EditMediaController.php" method="POST" class="form-group">
        <input type="hidden" name="titre" value="<?= htmlspecialchars($titreRecherche) ?>" />

        <label>Date :</label>
        <input type="date" name="date" value="<?= htmlspecialchars($mediaData['date']) ?>" required />

        <label>Durée (min) :</label>
        <input type="number" name="duree" value="<?= htmlspecialchars($mediaData['duree']) ?>" required />

        <label>Genre :</label>
        <input type="text" name="genre" value="<?= htmlspecialchars($mediaData['genre']) ?>" required />

        <label>Réalisateur :</label>
        <input type="text" name="realisateur" value="<?= htmlspecialchars($mediaData['realisateur']) ?>" required />

        <label>Note (0-10) :</label>
        <input type="number" name="note" min="0" max="10" value="<?= htmlspecialchars($mediaData['note']) ?>" required />

        <label>Description :</label>
        <textarea name="description" required><?= htmlspecialchars($mediaData['description']) ?></textarea>

        <label>Affiche (URL) :</label>
        <input type="text" name="affiche" value="<?= htmlspecialchars($mediaData['affiche']) ?>" required />

        <label>Lien média :</label>
        <input type="text" name="lien_media" value="<?= htmlspecialchars($mediaData['lien_media']) ?>" required />

        <label>Lien bande-annonce :</label>
        <input type="text" name="lien_bande_annonce" value="<?= htmlspecialchars($mediaData['lien_bande_annonce']) ?>" required />

        <button type="submit">Modifier le film</button>
    </form>
<?php endif; ?>
<br/><br/><br/>
<?php
require_once "footer.php";
?>