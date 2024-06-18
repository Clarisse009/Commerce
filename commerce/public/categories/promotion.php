<?php
include '../includes/db.php';
include '../templates/header.php';

$page_title = "Décoration";
// Assurez-vous que ID_sous_cat est la colonne correcte pour filtrer les catégories
$categorie_id = 5; // Remplacez par l'ID correct pour la décoration

// Préparer et exécuter la requête SQL pour récupérer les produits de la catégorie Décoration
$sql = "SELECT * FROM article WHERE ID_sous_cat = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $categorie_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" type="text/css" href="../css/menu-mega.css">

</head>
<body>

<div class="product-list">
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="product">
            <a href="../product_description.php?id_article=<?php echo $row['id_article']; ?>">
                <img src="../images/<?php echo $row['image']; ?>" alt="<?php echo $row['nom']; ?>">
                <h2><?php echo $row['nom']; ?></h2>
                <p><?php echo $row['prix']; ?>€</p>
            </a>
        </div>
    <?php endwhile; ?>
</div>

<?php
include '../templates/footer.php';
?>
</body>
</html>
