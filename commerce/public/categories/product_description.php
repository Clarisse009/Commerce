<?php
include '../../config/database.php';  // Chemin d'accès correct au fichier database.php

if (!isset($_GET['id_article'])) {
    echo "ID du produit manquant.";
    exit;
}

$id_article = intval($_GET['id_article']);

// Récupérer les détails du produit depuis la base de données
$sql = "SELECT * FROM article WHERE Id_article = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_article);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    echo "Produit non trouvé.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($product['Nom']); ?></title>
    <link rel="stylesheet" href="../css/product_description.css"> 
</head>
<body>
    <div class="product-detail-container">
        <div class="image-gallery">
            <img src="../images/<?php echo htmlspecialchars($product['Image']); ?>" alt="<?php echo htmlspecialchars($product['Nom']); ?>">
            <div class="thumbnail-container">
                <!-- Affichez des images miniatures si disponibles -->
                <img src="../images/<?php echo htmlspecialchars($product['Image']); ?>" alt="Thumbnail" class="thumbnail">
            </div>
        </div>
        <div class="product-details">
            <h1><?php echo htmlspecialchars($product['Nom']); ?></h1>
            <p class="price"><?php echo htmlspecialchars($product['Prix']); ?>€</p>
            <div class="size-selection">
                <span>Choisissez votre taille :</span>
                <div class="sizes">
                    <?php
                    $tailles = explode(',', $product['Taille']);
                    foreach ($tailles as $taille) {
                        echo "<div class='size'>" . htmlspecialchars($taille) . "</div>";
                    }
                    ?>
                </div>
            </div>
            <div class="stock-status">
                <?php echo $product['Quantite'] > 0 ? '<span class="in-stock">En stock</span>' : '<span class="out-of-stock">Rupture de stock</span>'; ?>
            </div>
            <p class="description"><?php echo nl2br(htmlspecialchars($product['Description'])); ?></p>
            <div class="purchase-options">
                <a href="../cart/add_to_cart.php?id_article=<?php echo $product['Id_article']; ?>" class="add-to-cart">Ajouter au panier</a>
            </div>
            <div class="payment-info">
                <div class="alma-logo">
                    <span>3x</span>
                    <p>Paiement en 3x sans frais dès 150€ avec Alma</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
