<?php
spl_autoload_register(function (string $className) {
    require "$className.php";
});

require "header.php";
require_once "UserController.php";

$userController = new UserController();

if ($_POST) {
    unset($_POST["confirm-password"]);

    if (empty($_POST["password"])) {
        echo "<div class='alert alert-danger'>Le mot de passe est obligatoire.</div>";
    } else {
        $_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $newUser = new User([
            "name" => $_POST["name"],
            "email" => $_POST["email"],
            "password" => $_POST["password"]
        ]);

        $existingUser = null;
        try {
            $existingUser = $userController->getUserByEmail($_POST["email"]);
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Erreur lors de la vérification de l'e-mail : " . htmlspecialchars($e->getMessage()) . "</div>";
        }

        if ($existingUser) {
            echo "<div class='alert alert-danger'>Un compte avec cet e-mail existe déjà.</div>";
        } else {
            $userController->createUser($newUser);
            $_SESSION["name"] = $newUser->getName();
            $_SESSION["email"] = $newUser->getEmail();
            echo "<div id='response' class='success-message'>Utilisateur créé avec succès !</div>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        setTimeout(() => {
                            const responseDiv = document.getElementById('response');
                            if (responseDiv) {
                                responseDiv.style.transition = 'opacity 0.5s ease';
                                responseDiv.style.opacity = '0';
                                setTimeout(() => responseDiv.remove(), 500);
                            }
                        }, 5000);
                    });
                </script>";
        }
    }
}

if (!is_connected()) {
    echo '<script>window.location.href = "index.php";</script>';
    exit;
}
?>

<br/><br/><br/><br/><br/>

<button class="back" onclick="window.location.href='admin.php'"> &lt; Retour</button>

<form method="post" class="form-group">
    <label for="name">Nom</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Nom" required minlength="2" maxlength="60">

    <label for="email">Email</label>
    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>

    <label for="password">Mot de passe</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe" required>

    <label for="confirm-password">De nouveau</label>
    <input type="password" class="form-control" name="confirm-password" id="confirm-password" placeholder="Mot de passe" required>

    <button type="submit">Ajouter un utilisateur</button>
</form>

<br/><br/><br/>

<?php require "footer.php"; ?>