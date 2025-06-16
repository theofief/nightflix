<?php require "header.php"; ?>
<?php if (is_connected()): ?>
<?php else: ?>
    <script>
        window.location.href = "index.php";
    </script>
<?php endif ?>
<br/><br/><br/><br/><br/>

<button class="back" onclick="window.location.href='admin.php'"> < Retour</button>

<h1>Ajouter un nouveau film 🎬</h1>

<?php
if (isset($_GET['success'])) {
    echo '<p style="color: green;">✅ Film ajouté avec succès !</p>';
}
if (isset($_GET['error']) && $_GET['error'] === 'exists') {
    echo '<p style="color: red;">❌ Ce film existe déjà en base de données.</p>';
}
?>

<form action="AddMediaController.php" method="POST" class="form-group">
    <input name="titre" placeholder="Titre" required>
    <input type="date" name="date" required>
    <input type="number" name="duree" placeholder="Durée (min)" required>
    <input name="genre" placeholder="Genre" required>
    <input name="realisateur" placeholder="Réalisateur" required>
    <input type="number" name="note" min="0" max="10" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <input name="affiche" placeholder="URL de l'affiche" required>
    <input name="lien_media" placeholder="Lien media (JSON ou unique)" required>
    <input name="lien_bande_annonce" placeholder="Lien bande-annonce" required>
    <button type="submit">Ajouter le film 🎬</button>
</form>
<br/><br/><br/><br/><br/>

<?php require "footer.php"; ?>