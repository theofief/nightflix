<?php
require_once "header.php";
$allMedias = $mediaController->getAllMedias();
?>
<?php if (is_connected()): ?>
<?php else: ?>
    <script>
        window.location.href = "index.php";
    </script>
<?php endif ?>
<br/><br/><br/><br/><br/>

<button class="back" onclick="window.location.href='admin.php'"> < Retour</button>

<h1>Liste des films disponibles</h1>

<input type="text" id="searchBar" placeholder="Rechercher un film..." />

<?php if (empty($allMedias)): ?>
    <p>Aucun film trouvé.</p>
<?php else: ?>
    <table id="mediaTable">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Date</th>
                <th>Durée (min)</th>
                <th>Genre</th>
                <th>Réalisateur</th>
                <th>Note</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($allMedias as $media): ?>
            <tr>
                <td><?= htmlspecialchars($media['titre']) ?></td>
                <td><?= htmlspecialchars($media['date']) ?></td>
                <td><?= htmlspecialchars($media['duree']) ?></td>
                <td><?= htmlspecialchars($media['genre']) ?></td>
                <td><?= htmlspecialchars($media['realisateur']) ?></td>
                <td><?= htmlspecialchars($media['note']) ?>/10</td>
                <td>
                    <button class="edit-link back" data-titre="<?= htmlspecialchars($media['titre'], ENT_QUOTES) ?>">✏️</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<script>
document.querySelectorAll('.edit-link').forEach(link => {
    link.addEventListener('click', function(event) {
        event.preventDefault();
        const titre = this.getAttribute('data-titre');
        navigator.clipboard.writeText(titre).then(() => {
            window.location.href = 'editMedia.php?titre=' + encodeURIComponent(titre);
        }).catch(() => {
            window.location.href = 'editMedia.php?titre=' + encodeURIComponent(titre);
        });
    });
});

// Fonction de recherche
document.getElementById('searchBar').addEventListener('input', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#mediaTable tbody tr');
    rows.forEach(row => {
        const titre = row.cells[0].textContent.toLowerCase();
        if (titre.includes(filter)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>
<br/><br/><br/>
<?php
require_once "footer.php";
?>