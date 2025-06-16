<?php require "header.php"; ?>
<?php if (is_connected()): ?>
<?php else: ?>
    <script>
        window.location.href = "index.php";
    </script>
<?php endif ?>
<br/><br/><br/><br/><br/>

<button class="back" onclick="window.location.href='admin.php'"> < Retour</button>

<h1>Supprimer un film 🎬</h1>

<?php
if (isset($_GET['success'])) {
    echo '<p style="color: green;">✅ Film supprimé avec succès !</p>';
}
if (isset($_GET['error']) && $_GET['error'] === 'notfound') {
    echo '<p style="color: red;">❌ Le film que vous avez saisi n\'existe pas.</p>';
}
?>

<form action="DeleteMediaController.php" method="POST">
    <input name="titre" placeholder="Titre du film à supprimer" required>
    <button type="submit">Supprimer le film ❌</button>
</form>
<br/><br/><br/>

<?php require "footer.php"; ?>