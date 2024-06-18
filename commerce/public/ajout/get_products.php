<?php
include '../../config/database.php';

$query = "SELECT a.ID_article, a.Nom, a.Prix, a.Image, a.Description, a.Matiere, a.ID_cat, 
                 v.Couleur, v.Taille, v.Quantite 
          FROM article a 
          LEFT JOIN variantes v ON a.ID_article = v.ID_article";

$result = $conn->query($query);

$products = [];
while ($row = $result->fetch_assoc()) {
    $productId = $row['ID_article'];
    if (!isset($products[$productId])) {
        $products[$productId] = [
            'id' => $row['ID_article'],
            'name' => $row['Nom'],
            'price' => $row['Prix'],
            'image' => $row['Image'],
            'description' => $row['Description'],
            'matiere' => $row['Matiere'],
            'category' => $row['ID_cat'],
            'variations' => []
        ];
    }
    $products[$productId]['variations'][] = [
        'color' => $row['Couleur'],
        'size' => $row['Taille'],
        'quantity' => $row['Quantite']
    ];
}

echo json_encode(array_values($products));
?>
