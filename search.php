<?php
require_once "header.php";
$allMedias = $mediaController->getAllMedias();
?>

<br><br><br><br><br>
<h1 style="text-align: center;">🎬 Liste des films disponibles</h1>

<div style="text-align: center;">
    <input type="text" id="searchBar" placeholder="🔍 Rechercher un film..." style="width: 50%; padding: 10px; margin: 20px auto; border-radius: 8px; border: 1px solid #ccc;" autofocus />
</div>

<?php if (empty($allMedias)): ?>
    <p id="noResults" style="text-align:center;">Aucun film disponible.</p>
<?php else: ?>
    <p id="noResults" style="text-align:center; display:none;">Aucun film trouvé.</p>

    <div id="mediaGrid" class="media-grid">
        <?php foreach ($allMedias as $media): ?>
            <div class="media-card" data-titre="<?= htmlspecialchars($media['titre']) ?>">
                <img src="<?= htmlspecialchars($media['affiche']) ?>" alt="Affiche de <?= htmlspecialchars($media['titre']) ?>" class="media-poster">
                <div class="media-info">
                    <h3><?= htmlspecialchars($media['titre']) ?></h3>
                    <p><strong>📅 Date :</strong> <?= htmlspecialchars($media['date']) ?></p>
                    <p><strong>⏱️ Durée :</strong> <?= htmlspecialchars($media['duree']) ?> min</p>
                    <p><strong>🎭 Genre :</strong> <?= htmlspecialchars($media['genre']) ?></p>
                    <p><strong>🎬 Réalisateur :</strong> <?= htmlspecialchars($media['realisateur']) ?></p>
                    <p><strong>⭐ Note :</strong> <?= htmlspecialchars($media['note']) ?>/10</p>
                    <a href="watch.php?media=<?= urlencode($media['titre']) ?>" class="watch-button">▶️ Regarder</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchBar = document.getElementById('searchBar');
        const cards = Array.from(document.querySelectorAll('.media-card'));
        const noResults = document.getElementById('noResults');

        searchBar.focus();

        searchBar.addEventListener('input', function () {
            const filter = this.value.toLowerCase();
            let visibleCount = 0;

            cards.forEach(card => {
                const titre = card.dataset.titre.toLowerCase();
                const match = titre.includes(filter);

                if (match) {
                    card.classList.remove('hidden-card');
                    visibleCount++;
                } else {
                    card.classList.add('hidden-card');
                }
            });

            noResults.style.display = visibleCount === 0 ? 'block' : 'none';
        });
    });
</script>

<?php require_once "footer.php"; ?>