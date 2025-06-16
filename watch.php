<?php
require "header.php";
$mediaController = new MediaController();

// Récupérer le titre depuis l'URL
$titre = urldecode($_GET['media'] ?? '');
$titre = trim($titre);

// Vérifier que le titre n'est pas vide
if ($titre === '') {
    echo "<p>Média non spécifié ❌</p>";
    require "footer.php";
    exit;
}

// Rechercher le média par son titre
$media = $mediaController->readByTitle($titre);

// Si aucun média trouvé
if (!$media) {
    echo "<p>Média introuvable 😥</p>";
    require "footer.php";
    exit;
}
?>

<div id="preview-top" style="background-image: url('<?= htmlspecialchars($media->getAffiche()) ?>')" alt="Affiche de <?= htmlspecialchars($media->getTitre()) ?>"></div>

<!-- Affichage des infos du média -->
<div class="media-page">
    <div class="card">
        <h1><?= htmlspecialchars($media->getTitre()) ?></h1>

        <?php if ($media->getLienBandeAnnonce()): ?>
            <h2>Bande annonce</h2>
            <iframe width="560" height="400" name="x_player_wfx" id="x_player_wfx" src="<?= ($media->getLienBandeAnnonce()) ?>" frameborder="0" allowfullscreen></iframe>
        <?php else: ?>
            <p style="color:red">Aucune bande annonce disponible 😢</p>
        <?php endif; ?>
        <div class="card-info">
            <p><strong>Note :</strong> <?= htmlspecialchars($media->getNote()) ?>/10</p>
            <p><strong>Description :</strong> <?= nl2br(htmlspecialchars($media->getDescription())) ?></p>
            <p><strong>Genre :</strong> <?= htmlspecialchars($media->getGenre()) ?></p>
            <p><strong>Date de sortie :</strong> <?= htmlspecialchars($media->getDate()) ?></p>
        </div>

        <?php if ($media->getLienMedia()): ?>
            <iframe width="560" height="400" name="x_player_wfx" id="x_player_wfx" src="<?= ($media->getLienMedia()) ?>" frameborder="0" allowfullscreen></iframe>
        <?php else: ?>
            <p style="color:red">Aucun lien vidéo disponible 😢</p>
        <?php endif; ?>
    </div>

    <?php
    if (isset($_GET['posted']) && $_GET['posted'] === '1') {
        echo '<p style="color:green; font-weight:bold;">✅ Votre commentaire a bien été posté, merci !</p>';
    }

    if (isset($_GET['error'])) {
        echo '<p style="color:red; font-weight:bold;">❌ Erreur : ' . htmlspecialchars($_GET['error']) . '</p>';
    }

    $commentaires = $media->getCommentaires(); // ici, PAS de json_decode

    if (!empty($commentaires) && is_array($commentaires)): ?>
        <div class="commentaires">
            <h2>Commentaires 🗨️</h2>
            <ul>
                <?php foreach ($commentaires as $index => $commentaire): ?>
                    <li>
                        <strong><?= htmlspecialchars($commentaire['utilisateur']) ?></strong>
                        (<?= htmlspecialchars($commentaire['note']) ?>/10) :<br>
                        <?= htmlspecialchars($commentaire['texte']) ?>
                        <?php if (is_connected()): ?>
                            <form method="POST" action="deleteComment.php" style="display:inline">
                                <input type="hidden" name="media" value="<?= htmlspecialchars($media->getTitre()) ?>">
                                <input type="hidden" name="index" value="<?= $index ?>">
                                <button type="submit" class="btn btn-sm btn-danger">❌ Supprimer</button>
                            </form>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <div class="commentaires">
                <h2>Commentaires 🗨️</h2>
                <p>Aucun commentaire pour le moment. Soyez le premier à commenter !</p>
            <?php endif; ?>

            <h2>Ajouter un commentaire</h2>
            <form id="commentForm" action="addComment.php" method="POST">
                <input type="hidden" name="titre" value="<?= htmlspecialchars($media->getTitre()) ?>">

                <label for="utilisateur">Votre pseudo :</label><br>
                <input type="text" id="utilisateur" name="utilisateur" required><br><br>

                <label for="note">Note (0 à 10) :</label><br>
                <input type="number" id="note" name="note" min="0" max="10" required><br><br>

                <label for="texte">Votre commentaire :</label><br>
                <textarea id="texte" name="texte" rows="5" cols="40" required></textarea><br><br>

                <button type="submit" id="submitBtn">Envoyer le commentaire</button>
            </form>
            </div>
        </div>

        <script>
            const form = document.getElementById('commentForm');
            const submitBtn = document.getElementById('submitBtn');
            const cooldownTime = 30; // secondes
            let cooldown = false;

            form.addEventListener('submit', function(e) {
                if (cooldown) {
                    e.preventDefault();
                    alert(`Merci de patienter ${cooldownTime} secondes avant de commenter à nouveau.`);
                    return false;
                }
                cooldown = true;
                submitBtn.disabled = true;

                // Affichage du compteur sur le bouton
                let timeLeft = cooldownTime;
                const interval = setInterval(() => {
                    timeLeft--;
                    submitBtn.textContent = `Patientez ${timeLeft}s`;
                    if (timeLeft <= 0) {
                        clearInterval(interval);
                        submitBtn.textContent = 'Envoyer le commentaire';
                        submitBtn.disabled = false;
                        cooldown = false;
                    }
                }, 1000);
            });
        </script>

        <script>
            setTimeout(() => {
                const msg = document.querySelector('p[style*="color:green"]');
                if (msg) msg.style.display = 'none';
            }, 5000);
        </script>

        <?php require "footer.php"; ?>