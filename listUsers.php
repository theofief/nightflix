<?php
require_once "header.php";
require_once "UserController.php";
require_once "User.php";

$userController = new UserController();

// 🔥 Suppression par email
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user_email'])) {
    $email = $_POST['delete_user_email'];
    $userController->deleteUserByEmail($email);
    $_SESSION['success_message'] = "✅ Utilisateur supprimé avec succès.";
    header("Location: listUsers.php");
    exit();
}

$successMessage = "";
if (isset($_SESSION['success_message'])) {
    $successMessage = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

$users = $userController->readAllUser();
?>

<?php if (!is_connected()): ?>
    <script>window.location.href = "index.php";</script>
<?php endif ?>

<br/><br/><br/><br/><br/>
<button class="back" onclick="window.location.href='admin.php'"> < Retour</button>

<h1>Liste des utilisateurs</h1>

<!-- ✅ Message de validation -->
<?php if (!empty($successMessage)): ?>
    <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
        <?= $successMessage ?>
    </div>
<?php endif; ?>

<input type="text" id="searchBar" placeholder="🔍 Rechercher par nom ou email..." /><br/>
<button class="back" onclick="window.location.href='register.php'">Ajouter un utilisateur</button>

<?php if (empty($users)): ?>
    <p>Aucun utilisateur trouvé.</p>
<?php else: ?>
    <table id="userTable">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Mot de passe (hash)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user->getName()) ?></td>
                <td><?= htmlspecialchars($user->getEmail()) ?></td>
                <td style="word-break: break-all;"><?= htmlspecialchars($user->getPassword()) ?></td>
                <td>
                    <form method="POST" onsubmit="return confirm('Tu es sûr de vouloir supprimer cet utilisateur ?');">
                        <input type="hidden" name="delete_user_email" value="<?= $user->getEmail() ?>">
                        <button type="submit" class="delete-btn">🗑️</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<script>
    document.getElementById('searchBar').addEventListener('input', function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#userTable tbody tr');
        rows.forEach(row => {
            const name = row.cells[0].textContent.toLowerCase();
            const email = row.cells[1].textContent.toLowerCase();
            row.style.display = (name.includes(filter) || email.includes(filter)) ? '' : 'none';
        });
    });
</script>

<br/><br/><br/>

<?php require_once "footer.php"; ?>