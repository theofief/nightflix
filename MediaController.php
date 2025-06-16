<?php
require_once "Media.php";

class MediaController
{
    private PDO $db;

    public function __construct()
    {
        $dbName = "nightflix";
        $port = 8889;
        $userName = "root";
        $password = "root";
        try {
            $this->setDb(new PDO("mysql:host=127.0.0.1;dbname=$dbName;port=$port;charset=utf8mb4", $userName, $password));
        } catch (PDOException $error) {
            echo "<p style='color:red'>{$error->getMessage()}</p>";
            die("Impossible de se connecter à la base de données.");
        }
    }

    public function setDb(PDO $db): void
    {
        $this->db = $db;
    }

    public function createMedia(Media $media): void
    {
        $req = $this->db->prepare("INSERT INTO `medias` 
        (titre, date, duree, genre, realisateur, note, description, affiche, lien_media, lien_bande_annonce) 
        VALUES 
        (:titre, :date, :duree, :genre, :realisateur, :note, :description, :affiche, :lien_media, :lien_bande_annonce)");

        $req->bindValue(":titre", $media->getTitre(), PDO::PARAM_STR);
        $req->bindValue(":date", $media->getDate(), PDO::PARAM_STR); // YYYY-MM-DD
        $req->bindValue(":duree", $media->getDuree(), PDO::PARAM_INT);
        $req->bindValue(":genre", $media->getGenre(), PDO::PARAM_STR);
        $req->bindValue(":realisateur", $media->getRealisateur(), PDO::PARAM_STR);
        $req->bindValue(":note", $media->getNote(), PDO::PARAM_INT);
        $req->bindValue(":description", $media->getDescription(), PDO::PARAM_STR);
        $req->bindValue(":affiche", $media->getAffiche(), PDO::PARAM_STR);
        $req->bindValue(":lien_media", json_encode($media->getLienMedia()), PDO::PARAM_STR);
        $req->bindValue(":lien_bande_annonce", $media->getLienBandeAnnonce(), PDO::PARAM_STR);

        $req->execute();
    }

    public function updateMedia(Media $media): void
    {
        $req = $this->db->prepare("UPDATE medias SET 
        date = :date,
        duree = :duree,
        genre = :genre,
        realisateur = :realisateur,
        note = :note,
        description = :description,
        affiche = :affiche,
        lien_media = :lien_media,
        lien_bande_annonce = :lien_bande_annonce,
        commentaires = :commentaires
        WHERE titre = :titre
    ");

        $req->bindValue(":date", $media->getDate(), PDO::PARAM_STR);
        $req->bindValue(":duree", $media->getDuree(), PDO::PARAM_INT);
        $req->bindValue(":genre", $media->getGenre(), PDO::PARAM_STR);
        $req->bindValue(":realisateur", $media->getRealisateur(), PDO::PARAM_STR);
        $req->bindValue(":note", $media->getNote(), PDO::PARAM_INT);
        $req->bindValue(":description", $media->getDescription(), PDO::PARAM_STR);
        $req->bindValue(":affiche", $media->getAffiche(), PDO::PARAM_STR);
        $req->bindValue(":lien_media", $media->getLienMedia(), PDO::PARAM_STR);
        $req->bindValue(":lien_bande_annonce", $media->getLienBandeAnnonce(), PDO::PARAM_STR);
        $req->bindValue(":commentaires", json_encode($media->getCommentaires()), PDO::PARAM_STR);
        $req->bindValue(":titre", $media->getTitre(), PDO::PARAM_STR); // Utilisé comme identifiant

        $req->execute();
    }

    public function deleteMedia(int $id): void
    {
        $req = $this->db->prepare("DELETE FROM `medias` WHERE id=:id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();
    }

    public function readMedian(): void {}


    public function readAllMedia(): array
    {
        $medias = [];
        $req = $this->db->prepare("SELECT * FROM `medias`");
        $req->execute();
        $datas = $req->fetchAll();
        foreach ($datas as $data) {

            $medias[] = new Media($data);
        }
        return $medias;
    }

    public function readLastMedia(): array
    {
        $medias = [];
        $req = $this->db->prepare("SELECT * FROM `medias` ORDER BY date DESC LIMIT 1");
        $req->execute();
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $medias[] = new Media($data);
        }
        return $medias;
    }

    public function readLatestMedia(): array
    {
        $medias = [];
        $req = $this->db->prepare("SELECT * FROM `medias` ORDER BY date DESC LIMIT 3");
        $req->execute();
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $medias[] = new Media($data);
        }
        return $medias;
    }

    public function readSuggestedMedia(): array
    {
        $medias = [];
        $req = $this->db->prepare("SELECT * FROM `medias` ORDER BY RAND() LIMIT 3");
        $req->execute();
        $datas = $req->fetchAll();

        foreach ($datas as $data) {
            $medias[] = new Media($data);
        }
        return $medias;
    }

    public function readMovies(): array
    {
        $medias = [];
        $req = $this->db->prepare("SELECT * FROM `medias` ORDER BY RAND() LIMIT 3");
        $req->execute();
        $datas = $req->fetchAll();

        foreach ($datas as $data) {
            $medias[] = new Media($data);
        }
        return $medias;
    }

    public function readByTitle(string $titre): ?Media
    {
        $req = $this->db->prepare("SELECT * FROM medias WHERE titre = :titre LIMIT 1");
        $req->bindValue(':titre', $titre, PDO::PARAM_STR);
        $req->execute();
        $data = $req->fetch();

        return $data ? new Media($data) : null;
    }

    public function addCommentToMedia(string $mediaTitle, array $newComment): void
    {
        // Étape 1 : récupérer les commentaires actuels
        $req = $this->db->prepare("SELECT commentaires FROM medias WHERE titre = :titre");
        $req->bindValue(":titre", $mediaTitle, PDO::PARAM_STR);
        $req->execute();
        $result = $req->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            throw new Exception("Média '$mediaTitle' introuvable !");
        }

        // Étape 2 : décoder les commentaires
        $commentaires = json_decode($result['commentaires'], true) ?? [];

        // Étape 3 : ajouter le nouveau commentaire
        $commentaires[] = $newComment;

        // Étape 4 : enregistrer les nouveaux commentaires
        $update = $this->db->prepare("UPDATE medias SET commentaires = :commentaires WHERE titre = :titre");
        $update->bindValue(":commentaires", json_encode($commentaires), PDO::PARAM_STR);
        $update->bindValue(":titre", $mediaTitle, PDO::PARAM_STR);
        $update->execute();
    }

    public function deleteCommentFromMedia(string $titre, int $index): void
    {
        $media = $this->readByTitle($titre);
        if (!$media) {
            throw new Exception("Média introuvable");
        }

        $commentaires = $media->getCommentaires();

        if (!isset($commentaires[$index])) {
            throw new Exception("Commentaire introuvable");
        }

        unset($commentaires[$index]);
        $commentaires = array_values($commentaires); // Re-indexation
        $media->setCommentaires($commentaires);
        $this->updateMedia($media);
    }

    public function mediaExists(string $titre): bool
    {
        $req = $this->db->prepare("SELECT COUNT(*) FROM medias WHERE titre = :titre");
        $req->bindValue(":titre", $titre, PDO::PARAM_STR);
        $req->execute();
        return $req->fetchColumn() > 0;
    }

    public function addMediaDirectly(
        string $titre,
        string $date,
        int $duree,
        string $genre,
        string $realisateur,
        int $note,
        string $description,
        string $affiche,
        string $lienMedia, // <- maintenant en string
        string $lienBandeAnnonce,
        array $commentaires // <- reste un tableau à encoder en JSON
    ): void {
        $req = $this->db->prepare("INSERT INTO `medias` 
    (titre, date, duree, genre, realisateur, note, description, affiche, lien_media, lien_bande_annonce, commentaires) 
    VALUES 
    (:titre, :date, :duree, :genre, :realisateur, :note, :description, :affiche, :lien_media, :lien_bande_annonce, :commentaires)");

        $req->bindValue(":titre", $titre, PDO::PARAM_STR);
        $req->bindValue(":date", $date, PDO::PARAM_STR);
        $req->bindValue(":duree", $duree, PDO::PARAM_INT);
        $req->bindValue(":genre", $genre, PDO::PARAM_STR);
        $req->bindValue(":realisateur", $realisateur, PDO::PARAM_STR);
        $req->bindValue(":note", $note, PDO::PARAM_INT);
        $req->bindValue(":description", $description, PDO::PARAM_STR);
        $req->bindValue(":affiche", $affiche, PDO::PARAM_STR);
        $req->bindValue(":lien_media", $lienMedia, PDO::PARAM_STR); // <- plus de json_encode()
        $req->bindValue(":lien_bande_annonce", $lienBandeAnnonce, PDO::PARAM_STR);
        $req->bindValue(":commentaires", json_encode($commentaires), PDO::PARAM_STR);

        $req->execute();
    }

    public function deleteMediaByTitleIfExists(string $titre): bool
    {
        // Vérifier si le film existe
        $check = $this->db->prepare("SELECT COUNT(*) FROM `medias` WHERE `titre` = :titre");
        $check->bindValue(":titre", $titre, PDO::PARAM_STR);
        $check->execute();
        $exists = $check->fetchColumn();

        if ($exists > 0) {
            // Supprimer si trouvé
            $delete = $this->db->prepare("DELETE FROM `medias` WHERE `titre` = :titre");
            $delete->bindValue(":titre", $titre, PDO::PARAM_STR);
            $delete->execute();
            return true;
        } else {
            return false;
        }
    }

    public function getMediaByTitle(string $titre): ?array
    {
        $req = $this->db->prepare("SELECT * FROM medias WHERE titre = :titre LIMIT 1");
        $req->bindValue(":titre", $titre, PDO::PARAM_STR);
        $req->execute();

        $media = $req->fetch(PDO::FETCH_ASSOC);
        return $media ?: null;
    }

    public function updateMediaDirectly(
        string $titre,
        string $date,
        int $duree,
        string $genre,
        string $realisateur,
        int $note,
        string $description,
        string $affiche,
        string $lien_media,
        string $lien_bande_annonce,
        array $commentaires
    ): void {
        $req = $this->db->prepare("UPDATE medias SET 
        date = :date,
        duree = :duree,
        genre = :genre,
        realisateur = :realisateur,
        note = :note,
        description = :description,
        affiche = :affiche,
        lien_media = :lien_media,
        lien_bande_annonce = :lien_bande_annonce,
        commentaires = :commentaires
        WHERE titre = :titre
    ");

        $req->bindValue(":date", $date, PDO::PARAM_STR);
        $req->bindValue(":duree", $duree, PDO::PARAM_INT);
        $req->bindValue(":genre", $genre, PDO::PARAM_STR);
        $req->bindValue(":realisateur", $realisateur, PDO::PARAM_STR);
        $req->bindValue(":note", $note, PDO::PARAM_INT);
        $req->bindValue(":description", $description, PDO::PARAM_STR);
        $req->bindValue(":affiche", $affiche, PDO::PARAM_STR);
        $req->bindValue(":lien_media", $lien_media, PDO::PARAM_STR);
        $req->bindValue(":lien_bande_annonce", $lien_bande_annonce, PDO::PARAM_STR);
        $req->bindValue(":commentaires", json_encode($commentaires), PDO::PARAM_STR);
        $req->bindValue(":titre", $titre, PDO::PARAM_STR);

        $req->execute();
    }

    public function getAllMedias(): array
    {
        $req = $this->db->prepare("SELECT * FROM medias ORDER BY date DESC");
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}
