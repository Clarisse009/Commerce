<?php
// public/panier.php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/controllers/PanierController.php';

$controller = new PanierController();

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'ajouter':
        $controller->ajouterAuPanier();
        break;
    case 'afficher':
        $controller->afficherPanier();
        break;
    default:
        echo "Action non reconnue.";
        break;
}
?>
