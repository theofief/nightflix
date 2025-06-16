<?php
spl_autoload_register(function (string $className) {
    require "$className.php";
});
$mediaController = new MediaController();
?>

<?php
require "header.php";
require_once "UserController.php";
?>

<?php if (is_connected()): ?>
<?php else: ?>
    <script>
        window.location.href = "index.php";
    </script>
<?php endif ?>

<br/><br/><br/><br/><br/>
<h1>Bienvenue dans le panel admin</h1>
<br/>
<div class="a-container">
    <a href="addMedia.php"><h3>Ajouter un média</h3></a>
    <br/>
    <a href="deleteMedia.php"><h3>Supprimer un média</h3></a>
    <br/>
    <a href="editMedia.php"><h3>Mettre à jour un média</h3></a>
    <br/>
    <a href="showAllMedia.php"><h3>Lister les médias</h3></a>
    <br/>
    <a href="register.php"><h3>Ajouter un utilisateur</h3></a>
    <br/>
    <a href="listUsers.php"><h3>Lister les utilisateurs</h3></a>
    <br/>
    <a href="newsLetterList.php"><h3>Lister les mails de la news letter</h3></a>
</div>
<br/><br/><br/><br/><br/>

<?php require "footer.php"; ?>