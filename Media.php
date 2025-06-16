<?php

class Media
{
    # Attributs
    private int $id;
    private string $titre;
    private string $date; // format YYYY-MM-DD
    private int $duree;
    private string $genre;
    private string $realisateur;
    private int $note;
    private string $description;
    private string $affiche;
    private string $lien_media;
    private string $lien_bande_annonce;
    private array $commentaires = [];

    # Méthodes
    public function __construct(array $data)
    {
        $this->hydrate($data);
        $this->lien_media = $data["lien_media"] ?? "";
        $this->lien_bande_annonce = $data["lien_bande_annonce"] ?? "";
        $this->commentaires = isset($data["commentaires"]) ? json_decode($data["commentaires"], true) : [];
    }

    public function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            $method = "set" . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;
        return $this;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getDuree(): int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;
        return $this;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;
        return $this;
    }

    public function getRealisateur(): string
    {
        return $this->realisateur;
    }

    public function setRealisateur(string $realisateur): self
    {
        $this->realisateur = $realisateur;
        return $this;
    }

    public function getNote(): int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getAffiche(): string
    {
        return $this->affiche;
    }

    public function setAffiche(string $affiche): self
    {
        $this->affiche = $affiche;
        return $this;
    }

    public function getLienMedia(): string
    {
        return $this->lien_media;
    }

    public function setLienMedia($lien_media): self
    {
        $this->lien_media = $lien_media;
        return $this;
    }

    public function getLienBandeAnnonce(): string
    {
        return $this->lien_bande_annonce;
    }

    public function setLienBandeAnnonce(string $lien_bande_annonce): self
    {
        $this->lien_bande_annonce = $lien_bande_annonce;
        return $this;
    }

    public function getCommentaires(): array
    {
        return $this->commentaires;
    }

    public function setCommentaires(array|string $commentaires): self
    {
        if (is_string($commentaires)) {
            $this->commentaires = json_decode($commentaires, true) ?? [];
        } else {
            $this->commentaires = $commentaires;
        }
        return $this;
    }
}