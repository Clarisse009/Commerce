<?php
include('../../config/database.php');
include('../../templates/header.php');  // Inclusion du header

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    $stmt = $conn->prepare("SELECT * FROM article WHERE Id_cat = ?");
    $stmt->execute([$category_id]);
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($articles) {
        foreach ($articles as $article) {
            echo "<h2>{$article['nom']}</h2>";
            echo "<p>{$article['description']}</p>";
            echo "<p>Prix: {$article['prix']}€</p>";
        }
    } else {
        echo "Aucun article trouvé pour cette catégorie.";
    }
} else {
    echo "Aucune catégorie spécifiée. Utilisez l'URL avec un paramètre category_id.";
}
?>
