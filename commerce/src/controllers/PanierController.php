<?php
// src/controllers/PanierController.php

include_once __DIR__ . '/../../config/database.php';
include_once __DIR__ . '/../models/Panier.php';

class PanierController {
    private $panier;

    public function __construct() {
        global $conn;
        $this->panier = new Panier($conn);
    }

    public function ajouterAuPanier() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id_pers = $_POST['id_pers'];
            $id_article = $_POST['id_article'];
            $quantite = $_POST['quantite'];

            if ($this->panier->ajouterAuPanier($id_pers, $id_article, $quantite)) {
                echo "Article ajouté au panier avec succès";
            } else {
                echo "Erreur lors de l'ajout de l'article au panier";
            }
        }
    }

    public function afficherPanier() {
        $id_pers = $_GET['id_pers'];
        $articles = $this->panier->obtenirPanier($id_pers);
        include __DIR__ . '/../views/panier_view.php';
    }
}
?>
