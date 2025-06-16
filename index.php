<?php
require "header.php";

$lastMedia = $mediaController->readLastMedia();
$latestMedias = $mediaController->readLatestMedia();
$suggestedMedias = $mediaController->readSuggestedMedia();
$movieMedias = $mediaController->readMovies();
?>

<?php foreach ($lastMedia as $media): ?>
  <div id="preview-top" style="position: relative; background-image: url('<?= htmlspecialchars($media->getAffiche()) ?>');">
    <div class="first" style="position: absolute; bottom: 0; left: 20px;">
      <h2><?= htmlspecialchars($media->getTitre()) ?></h2>
      <h3>Notation: <?= htmlspecialchars($media->getNote()) ?>/10</h3>
      <button class="play-button" onclick="window.location.href='watch.php?media=<?= htmlspecialchars($media->getTitre()) ?>'">Regarder</button>
    </div>
  </div>
<?php endforeach; ?>

<?php if (isset($_GET['subscribed'])): ?>
    <div id="newsletterResponse" class="success-message">
        <?= htmlspecialchars($_GET['subscribed']) ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(() => {
                const responseDiv = document.getElementById("newsletterResponse");
                if (responseDiv) {
                    responseDiv.style.transition = "opacity 0.5s ease";
                    responseDiv.style.opacity = "0";
                    setTimeout(() => responseDiv.remove(), 500); // on le retire complètement
                }
            }, 5000); // après 5 secondes
        });
    </script>
<?php endif; ?>

<?php if (!empty($latestMedias)): ?>
  <div id="quote"></div>

  <!-- New Arrivals -->
  <h2 id="new">New Arrivals</h2>
  <div id="new-arrivals">
    <div class="media-list">
      <?php foreach ($latestMedias as $media): ?>
        <a href="watch.php?media=<?= htmlspecialchars($media->getTitre()) ?>" class="movie-a">
          <div class="movie-item" style="background-image: url('<?= htmlspecialchars($media->getAffiche()) ?>');">
            <section class="infos">
              <h3><?= htmlspecialchars($media->getTitre()) ?></h3>
              <p>Rating: <?= htmlspecialchars($media->getNote()) ?></p>
            </section>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- You may like -->
  <h2 id="you">You may like</h2>
  <div id="you-may-like">
    <div class="media-list">
      <?php foreach ($suggestedMedias as $media): ?>
        <a href="watch.php?media=<?= htmlspecialchars($media->getTitre()) ?>" class="movie-a">
          <div class="movie-item" style="background-image: url('<?= htmlspecialchars($media->getAffiche()) ?>');">
            <section class="infos">
              <h3><?= htmlspecialchars($media->getTitre()) ?></h3>
              <p>Rating: <?= htmlspecialchars($media->getNote()) ?></p>
            </section>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Movies -->
  <h2 id="mov">Movies</h2>
  <div id="movies">
    <div class="media-list">
      <?php foreach ($movieMedias as $media): ?>
        <a href="watch.php?media=<?= htmlspecialchars($media->getTitre()) ?>" class="movie-a">
          <div class="movie-item" style="background-image: url('<?= htmlspecialchars($media->getAffiche()) ?>');">
            <section class="infos">
              <h3><?= htmlspecialchars($media->getTitre()) ?></h3>
              <p>Rating: <?= htmlspecialchars($media->getNote()) ?></p>
            </section>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
<?php endif; ?>

<?php require "footer.php"; ?>