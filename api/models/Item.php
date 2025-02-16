<?php

require_once './config/database.php';
class Item {
    private $conn;
    private $table_name = "items";

    public $id;
    public $nom;
    public $quantite;
    public $cree_le;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Créer un nouvel item
    public function add() {
        $query = "INSERT INTO " . $this->table_name . " SET nom = :nom, quantite = :quantite";
        $stmt = $this->conn->prepare($query);

        // Assainir les données
        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->quantite = htmlspecialchars(strip_tags($this->quantite));

        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":quantite", $this->quantite);

        return $stmt->execute();
    }

    // Récupérer un item par son ID
    public function getById() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        return $stmt;
    }

    // Récupérer la liste des items
    public function getList() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY cree_le DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Mettre à jour un item
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nom = :nom, quantite = :quantite WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->quantite = htmlspecialchars(strip_tags($this->quantite));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':quantite', $this->quantite);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    // Supprimer un item par son ID
    public function deleteById() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }
}

