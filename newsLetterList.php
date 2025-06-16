<?php
require_once "header.php";
require_once "MailController.php";

$newsletterController = new MailController();
$emails = $newsletterController->getAllMails();
$allEmails = implode(',', array_map(fn($m) => $m["mail"], $emails));
?>

<?php if (is_connected()): ?>
<?php else: ?>
    <script>
        window.location.href = "index.php";
    </script>
<?php endif ?>
<br /><br /><br /><br /><br />

<button class="back" onclick="window.location.href='admin.php'">
    < Retour</button>

        <h1>Liste des emails newsletter</h1>

        <?php if (isset($_GET['success'])): ?>
            <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                <?= htmlspecialchars($_GET['success']) ?>
            </div>
        <?php elseif (isset($_GET['error'])): ?>
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($emails)): ?>
            <a href="mailto:<?= htmlspecialchars($allEmails) ?>?subject=Newsletter" class="send-mail-button">
                ✉️ Envoyer un mail à tous
            </a>
        <?php endif; ?>

        <input type="text" id="searchBar" placeholder="🔍 Rechercher un email..." />
        <?php if (empty($emails)): ?>
            <p>Aucun email trouvé.</p>
        <?php else: ?>
            <table id="newsletterTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Action</th> <!-- Nouvelle colonne -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($emails as $index => $mail): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($mail["mail"]) ?></td>
                            <td>
                                <form method="POST" action="DeleteNewsLetter.php" onsubmit="return confirm('Supprimer cet email ?');">
                                    <input type="hidden" name="mail" value="<?= htmlspecialchars($mail["mail"]) ?>">
                                    <button type="submit" class="delete-btn">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <script>
            document.getElementById('searchBar').addEventListener('input', function() {
                const filter = this.value.toLowerCase();
                const rows = document.querySelectorAll('#newsletterTable tbody tr');
                rows.forEach(row => {
                    const email = row.cells[1].textContent.toLowerCase();
                    row.style.display = email.includes(filter) ? '' : 'none';
                });
            });
        </script>
        <br /><br /><br />
        <?php require_once "footer.php"; ?>