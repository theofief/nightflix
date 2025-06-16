<?php
class Mail {
    private int $id;
    private string $mail;

    public function __construct(int $id, string $mail) {
        $this->id = $id;
        $this->mail = $mail;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getMail(): string {
        return $this->mail;
    }
}