-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 16, 2025 at 07:49 AM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nightflix`
--

-- --------------------------------------------------------

--
-- Table structure for table `medias`
--

CREATE TABLE `medias` (
  `titre` text NOT NULL,
  `date` date NOT NULL,
  `duree` int NOT NULL,
  `genre` text NOT NULL,
  `realisateur` text NOT NULL,
  `note` int NOT NULL,
  `description` text NOT NULL,
  `affiche` text NOT NULL,
  `lien_media` text NOT NULL,
  `lien_bande_annonce` text NOT NULL,
  `commentaires` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `medias`
--

INSERT INTO `medias` (`titre`, `date`, `duree`, `genre`, `realisateur`, `note`, `description`, `affiche`, `lien_media`, `lien_bande_annonce`, `commentaires`) VALUES
('Red One (2024)', '2024-11-15', 123, 'Action', 'Jake Kasdan', 8, 'Après l\'enlèvement du Père Noël - Nom de code: Rouge - le chef de la sécurité du pôle Nord doit s\'associer avec le chasseur de primes le plus célèbre du monde dans une mission pleine d\'action à travers le globe pour sauver Noël.', 'https://i.ibb.co/S4hVdtjf/redone.jpg', 'https://www.youtube.com/embed/PFcoidHoiTQ?si=qCh_rTftGHdAR_zm', 'https://www.youtube.com/embed/PFcoidHoiTQ?si=qCh_rTftGHdAR_zm', '[]'),
('Kraven the Hunter', '2024-12-18', 127, 'Action', 'J.C. Chandor', 8, 'Lors d\'un safari avec son père Nikolai, un oligarque russe dont la cruauté a jadis poussé sa mère au suicide, Sergei Kravinoff est attaqué par un lion, qui vient très près de le tuer. La potion miraculeuse de Calypso, une prêtresse vaudou, permet non seulement au garçon de survivre ; elle lui confère aussi une force surhumaine et un nouvel objectif : protéger la nature des braconniers et des criminels de toutes sortes. Élevé au titre de \"chasseur\", ses faits d’armes attirent rapidement l’attention d’un assassin redoutable, dont les pouvoirs sont comparables aux siens : le Rhino.', 'https://i.ibb.co/n83Mc3qq/kraven.jpg', 'https://www.youtube.com/embed/7WbDpL6CTdE?si=FxZ_34IE7_pE4cS3', 'https://www.youtube.com/embed/7WbDpL6CTdE?si=FxZ_34IE7_pE4cS3', '[]'),
('Sonic The Hedgehog 3', '2024-12-25', 109, 'Science fiction', 'Jeff Fowler', 7, 'Sonic, Knuckles et Tails se retrouvent face à un nouvel adversaire, Shadow, mystérieux et puissant ennemi aux pouvoirs inédits. Dépassée sur tous les plans, la Team Sonic va devoir former une alliance improbable pour tenter d’arrêter Shadow et protéger notre planète.', 'https://i.ibb.co/mVyN6YV1/sonic3.webp', 'https://www.youtube.com/embed/TQ-9We-lxiA?si=L-tcxjZk_l09yhWj', 'https://www.youtube.com/embed/TQ-9We-lxiA?si=L-tcxjZk_l09yhWj', '[]'),
('Vaiana 2', '2024-11-27', 100, 'Animation', 'Dana Ledoux Miller, Jared Bush', 7, 'Vaiana, une jeune fille courageuse, reçoit une mystérieuse invitation de ses ancêtres et décide de se lancer dans une quête extraordinaire. Elle traverse les eaux dangereuses des îles du Pacifique, où elle vit des aventures inédites et affronte des défis qui bouleverseront son destin. Ce film d’animation vous plonge dans un récit riche en émotions, en découvertes et en action, au cœur de paysages enchanteurs. Une histoire captivante à découvrir absolument !', 'https://i.ibb.co/YHvYtrW/vaiana2.jpg', 'https://www.youtube.com/embed/HrVJe2P9Uuk?si=ZOgoWyyDZuLeWGzs', 'https://www.youtube.com/embed/HrVJe2P9Uuk?si=ZOgoWyyDZuLeWGzs', '[]'),
('Mufasa: The Lion King', '2024-12-18', 118, 'Animation', 'Barry Jenkins', 9, 'Dans Rafiki, la jeune lionne Kiara, fille de Simba et Nala, écoute Rafiki lui raconter la légende de Mufasa. Timon et Pumbaa, avec leur humour bien connu, viennent également enrichir l’histoire. Racontée à travers des flashbacks, cette légende suit Mufasa, un lionceau orphelin et solitaire, qui rencontre un jour Taka, héritier d’une lignée royale. Cette rencontre marque le début d’un voyage mouvementé pour un groupe d’outsiders unis par le destin. Leur amitié sera mise à l’épreuve lorsqu’ils devront s’allier pour survivre face à un ennemi redoutable et dangereux.', 'https://i.ibb.co/zTjnS2v5/mufasa.webp', 'https://www.youtube.com/embed/2rWXguw0S-k?si=lcr1s51RRMqI4jf0', 'https://www.youtube.com/embed/2rWXguw0S-k?si=lcr1s51RRMqI4jf0', '[]'),
('Captain America: Brave New World', '2025-02-12', 118, 'Action', 'Julius Onah', 7, 'Fraîchement introduit au nouveau président des États-Unis, Thaddeus Ross, Sam Wilson se retrouve entraîné dans une crise internationale majeure. Pris dans une course contre la montre, il doit percer les mystères d’un complot menaçant de plonger le monde dans le chaos avant que son instigateur n’agisse.', 'https://i.ibb.co/G4V0BHNb/cabnw.webp', 'https://www.youtube.com/embed/MOwkseguLXQ?si=8vXQveq-ZVtqmkbz', 'https://www.youtube.com/embed/MOwkseguLXQ?si=8vXQveq-ZVtqmkbz', '[]'),
('Blanche-Neige', '2025-03-19', 109, 'Fantastique', 'Marc Webb', 6, '\"Blanche-Neige\" des studios Disney est une nouvelle version du classique de 1937 en prises de vues réelles. Avec Rachel Zegler dans le rôle principal et Gal Gadot dans celui de sa belle-mère, la Méchante Reine. Cette aventure magique retourne aux sources du conte intemporel avec les adorables Timide, Prof, Simplet, Grincheux, Joyeux, Dormeur et Atchoum.', 'https://i.ibb.co/Bxr4yCD/blancheneige.jpg', 'https://www.youtube.com/embed/YCdykV32pGQ?si=33Ssj0ZnWSBF-jqN', 'https://www.youtube.com/embed/YCdykV32pGQ?si=33Ssj0ZnWSBF-jqN', '[]'),
('Minecraft', '2025-04-02', 101, 'Science fiction', 'Jared Hess', 7, 'Bienvenue dans l’univers de Minecraft où la créativité est essentielle à la survie ! Quatre outsiders – Garrett, Henry, Natalie et Dawn – sont soudainement projetés à travers un mystérieux portail menant à La Surface – un incroyable monde cubique qui prospère grâce à l’imagination. Pour rentrer chez eux, il leur faudra maîtriser ce monde (et le protéger de créatures maléfiques comme les Piglins et les Zombies), tout en s’engageant dans une quête fantastique aux côtés de Steve, expert fabricateur. Cette aventure les poussera à être audacieux et à développer leur créativité. Autant de facultés dont ils auront besoin pour s’épanouir dans le monde réel.', 'https://i.ibb.co/TMJZ2Zvf/minecraft.jpg', 'https://www.youtube.com/embed/Zk1cDp0gJbY?si=4i7kC_ld2zwJl4rw', 'https://www.youtube.com/embed/Zk1cDp0gJbY?si=4i7kC_ld2zwJl4rw', '[]'),
('Final Destination: Bloodlines', '2025-05-14', 110, 'Horreur', 'Zach Lipovsky, Adam B. Stein', 8, 'Hantée par un cauchemar terrifiant qui revient sans cesse, Stefanie, étudiante à l’université, rentre chez elle pour retrouver la trace de la seule personne susceptible d’enrayer ce cycle infernal et de sauver ses proches du sort funeste qui les attend…', 'https://i.ibb.co/JRvZBgnh/finaldest.jpg', 'https://www.youtube.com/embed/O1J_NzzLoT8?si=y6k8V1jItWIevcEi', 'https://www.youtube.com/embed/O1J_NzzLoT8?si=y6k8V1jItWIevcEi', '[]'),
('Mission: Impossible – The Final Reckoning', '2025-05-21', 169, 'Action', 'Christopher McQuarrie', 8, 'Nos vies sont la somme de nos choix. Tom Cruise est Ethan Hunt dans Mission: Impossible – The Final Reckoning.', 'https://i.ibb.co/4RsTfx64/mitfr.jpg', 'https://www.youtube.com/embed/1RNK3SOhL8U?si=2tm4ZRVRNDW2Fuzd', 'https://www.youtube.com/embed/1RNK3SOhL8U?si=2tm4ZRVRNDW2Fuzd', '[]'),
('Sinners', '2025-04-16', 137, 'Action', 'Ryan Coogler', 8, 'Deux frères jumeaux, déterminés à tourner la page sur un passé douloureux, retournent dans leur ville natale pour reconstruire leur vie. Mais leur arrivée réveille une force obscure qui les attendait dans l’ombre…', 'https://i.ibb.co/39C1Tptf/sinners.jpg', 'https://www.youtube.com/embed/xOjyx-U0O0U?si=R5q-qmL4HDVeYqyB', 'https://www.youtube.com/embed/xOjyx-U0O0U?si=R5q-qmL4HDVeYqyB', '[]'),
('Thunderbolts', '2025-04-30', 129, 'Action', 'Jake Schreier', 7, 'Marvel Studios rassemble une équipe de anti-héros peu conventionnelle : Yelena Belova, Bucky Barnes, Red Guardian, Le Fantôme, Taskmaster et John Walker. Tombés dans un piège redoutable tendu par Valentina Allegra de Fontaine, ces laissés pour compte complètement désabusés doivent participer à une mission à haut risque qui les forcera à se confronter aux recoins les plus sombres de leur passé. Ce groupe dysfonctionnel se déchirera-t-il ou trouvera-t-il sa rédemption en s’unissant avant qu’il ne soit trop tard ?', 'https://i.ibb.co/CpPwGLmH/thunderbolts.jpg', 'https://www.youtube.com/embed/cYHyGlHIOOY?si=Ws24mCeRnMbFuUvh', 'https://www.youtube.com/embed/cYHyGlHIOOY?si=Ws24mCeRnMbFuUvh', '[]'),
('Lilo and Stitch', '2025-05-21', 148, 'Animation', 'Dean Fleischer Camp', 7, 'L’histoire touchante et drôle d’une petite fille hawaïenne solitaire et d’un extra-terrestre fugitif qui l’aide à renouer le lien avec sa famille.', 'https://i.ibb.co/s0NBKhF/stitch.jpg', 'https://www.youtube.com/embed/PTTS50KDPas?si=0XDwWm8F06jDM-25', 'https://www.youtube.com/embed/PTTS50KDPas?si=0XDwWm8F06jDM-25', '[]'),
('Venom: The Last Dance', '2024-10-30', 110, 'Action', 'Kelly Marcel', 8, 'Eddie et Venom sont en cavale. Chacun est traqué par ses semblables et alors que l\'étau se resserre, le duo doit prendre une décision dévastatrice qui annonce la conclusion des aventures d\'Eddie et de Venom.', 'https://i.ibb.co/wFYN5QPj/vtld.jpg', 'https://www.youtube.com/embed/uCJu2RjSZyE?si=Eb4WycLpOq0y8mrp', 'https://www.youtube.com/embed/uCJu2RjSZyE?si=Eb4WycLpOq0y8mrp', '[]');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
