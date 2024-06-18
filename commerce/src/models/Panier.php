<?php
// src/models/Panier.php

class Panier {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function ajouterAuPanier($id_pers, $id_article, $quantite) {
        $sql = "INSERT INTO Contenir (ID_pers, Id_article, Quantite) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die('Error preparing statement: ' . $this->conn->error);
        }
        $stmt->bind_param("iii", $id_pers, $id_article, $quantite);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenirPanier($id_pers) {
        $sql = "SELECT Article.Nom, Contenir.Quantite, Article.Prix 
                FROM Contenir 
                JOIN Article ON Contenir.Id_article = Article.Id_article 
                WHERE Contenir.ID_pers = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die('Error preparing statement: ' . $this->conn->error);
        }
        $stmt->bind_param("i", $id_pers);
        $stmt->execute();
        $result = $stmt->get_result();

        $articles = [];
        while ($row = $result->fetch_assoc()) {
            $articles[] = $row;
        }

        return $articles;
    }
}
?>
