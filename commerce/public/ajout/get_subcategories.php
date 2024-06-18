<?php
include '../../config/database.php';

if (isset($_POST['id_cat'])) {
    $id_cat = intval($_POST['id_cat']);
    
    // Vérifier la connexion à la base de données
    if ($conn->connect_error) {
        die("La connexion a échoué: " . $conn->connect_error);
    }
    
    // Préparer et exécuter la requête SQL pour obtenir les sous-catégories
    $stmt = $conn->prepare("SELECT ID_sous_cat, Nom FROM sous_categorie WHERE ID_cat = ?");
    $stmt->bind_param("i", $id_cat);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Générer les options de sous-catégorie
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['ID_sous_cat'] . '">' . $row['Nom'] . '</option>';
        }
    } else {
        echo '<option value="">Aucune sous-catégorie disponible</option>';
    }
    
    $stmt->close();
} else {
    echo '<option value="">Erreur de récupération des sous-catégories</option>';
}

$conn->close();
?>
