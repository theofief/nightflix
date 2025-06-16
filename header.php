<?php
spl_autoload_register(function (string $className) {
    require "$className.php";
});
$mediaController = new MediaController();
session_start();

// TODO: 1. Montrer fonction :
function is_connected(): bool
{
    return $_SESSION && $_SESSION["email"] && $_SESSION["name"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/styles.css" />
    <title>Nightflix</title>
</head>

<body>
    <header>
        <div class="header-image" onclick="window.location.href='index.php'">
            <img src="images/logo.png" alt="Nightflix Logo" />
            <h1>Nightflix</h1>
        </div>
        <div>
            <nav id="mySidenav" class="sidenav">
                <ul>
                    <a id="closeBtn" href="#" class="close">×</a>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="index.php#new">Arrivages</a></li>
                    <li><a href="index.php#mov">Films</a></li>

                    <?php if (is_connected()): ?>
                        <li><a class="nav-link" href="./admin.php">Panel admin</a></li>

                        <li><a class="nav-link" href="./logout.php">Se déconnecter</a></li>
                    <?php else: ?>
                        <li><a class="nav-link" href="./login.php">Se connecter</a></li>
                    <?php endif ?>
                    <li><a class="search-button" href="./search.php">🔍</a></li>
                    <button id="mode-toggle">Changer le thème</button>
                </ul>
            </nav>
            <a href="#" id="openBtn">
                <span class="burger-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>
        </div>
    </header>

    <div id="surprise-img" style="
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background-color: black;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 9999;
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.3s ease;
">
        <img src="https://i.ibb.co/YTqyDyQ6/Chris-Chevalier-Avatar.png" alt="Surprise!" id="surprise-element" style="
    max-width: 100%;
    max-height: 100%;
    transform: scale(0);
    transition: transform 0.3s ease;
  ">
    </div>
    <script>
        const konamiCode = [
            "ArrowUp", "ArrowUp",
            "ArrowDown", "ArrowDown",
            "ArrowLeft", "ArrowRight",
            "ArrowLeft", "ArrowRight"
        ];

        let inputSequence = [];

        document.addEventListener("keydown", function(e) {
            inputSequence.push(e.key);

            // Garde la taille correcte
            if (inputSequence.length > konamiCode.length) {
                inputSequence.shift();
            }

            // Vérifie si la séquence est correcte
            if (inputSequence.join() === konamiCode.join()) {
                launchSurprise();
                inputSequence = []; // reset après activation
            }
        });

        function launchSurprise() {
            // 🔊 Lancer le cri
            new Audio('Aaahhhhh.mp3').play();

            const surprise = document.getElementById("surprise-img");
            const img = document.getElementById("surprise-element");

            surprise.style.opacity = "1";
            surprise.style.pointerEvents = "auto";

            // Zoom initial
            setTimeout(() => {
                img.style.transform = "scale(1.2)";
            }, 100);

            // Animations random
            setTimeout(() => {
                img.style.transform = "rotate(15deg) scale(1.4)";
            }, 700);

            setTimeout(() => {
                img.style.transform = "rotate(-15deg) scale(1.3)";
            }, 1100);

            setTimeout(() => {
                img.style.transform = "scale(3) rotate(0deg)";
            }, 1500);

            // Disparition
            setTimeout(() => {
                surprise.style.opacity = "0";
                img.style.transform = "scale(0)";
            }, 2500);

            setTimeout(() => {
                surprise.style.pointerEvents = "none";
            }, 3000);
        }
    </script>