<?php
// src/models/Personne.php

class Personne {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function ajouterPersonne($nom, $prenom, $telephone, $code_p, $email, $ville, $type_personne) {
        $sql = "INSERT INTO personne (Nom, Prenom, Telephone, Code_p, Email, Ville, type_personne) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssss", $nom, $prenom, $telephone, $code_p, $email, $ville, $type_personne);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
