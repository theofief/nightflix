<?php 
require "header.php";
require_once "UserController.php";

$userController = new UserController();

if ($_POST) {
    $user = $userController->getUserByEmail($_POST["email"]);
    if ($user && password_verify($_POST["password"], $user->getPassword())) {

        $_SESSION["email"] = $user->getEmail();
        $_SESSION["name"] = $user->getName();
        echo "<div class='alert alert-success'>Connexion réussie ! 🎉</div>";
        echo "<script>window.location.href='index.php'</script>";
    }
}
?>
<br/><br/><br/><br/><br/>
<form method="post" class="form-group">
    <label for="email">Mail</label>
    <input type="email" class="form-control" name="email" id="email" placeholder="Mail" required>
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>

    <button type="submit">Se connecter</button>
</form>

<?php require "footer.php" ?>