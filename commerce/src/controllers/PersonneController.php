<?php
// src/controllers/PersonneController.php

include_once __DIR__ . '/../../config/database.php';
include_once __DIR__ . '/../models/Personne.php';

class PersonneController {
    private $personne;

    public function __construct() {
        global $conn;
        $this->personne = new Personne($conn);
    }

    public function inscrirePersonne() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $telephone = $_POST['telephone'];
            $code_p = $_POST['code_p'];
            $email = $_POST['email'];
            $ville = $_POST['ville'];
            $type_personne = "client"; // Type par défaut pour les inscriptions

            if ($this->personne->ajouterPersonne($nom, $prenom, $telephone, $code_p, $email, $ville, $type_personne)) {
                echo "Inscription réussie";
            } else {
                echo "Erreur lors de l'inscription";
            }
        }
    }
}
?>
