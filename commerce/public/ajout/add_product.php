<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$page_title = "Ajouter un Produit";
include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $couleur = $_POST['couleur'];
    $taille = $_POST['taille'];
    $matiere = $_POST['matiere'];
    $quantite = $_POST['quantite'];
    $id_cat = $_POST['id_cat'];
    $description = $_POST['description'];

    // Gestion de l'image téléchargée
    $target_dir = '../../public/images/';
    $original_file_name = basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($original_file_name, PATHINFO_EXTENSION));
    $new_file_name = uniqid() . '.' . $imageFileType;
    $target_file = $target_dir . $new_file_name;
    $uploadOk = 1;

    // Vérifier si le fichier image est une image réelle
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $_SESSION['error'] = "Le fichier n'est pas une image.";
        $uploadOk = 0;
    }

    // Vérifier la taille du fichier
    if ($_FILES["image"]["size"] > 500000) {
        $_SESSION['error'] = "Désolé, votre fichier est trop volumineux.";
        $uploadOk = 0;
    }

    // Autoriser certains formats de fichier
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $_SESSION['error'] = "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
        $uploadOk = 0;
    }

    // Vérifier si $uploadOk est défini à 0 par une erreur
    if ($uploadOk == 0) {
        $_SESSION['error'] = "Désolé, votre fichier n'a pas été téléchargé.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Enregistrer les informations du produit et le chemin de l'image dans la base de données
            $stmt = $conn->prepare("INSERT INTO article (Nom, Prix, Couleur, Taille, Matiere, Quantite, ID_cat, Description, Image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            if ($stmt === false) {
                $_SESSION['error'] = "Erreur de préparation : " . htmlspecialchars($conn->error);
            } else {
                $stmt->bind_param("sisssisss", $nom, $prix, $couleur, $taille, $matiere, $quantite, $id_cat, $description, $new_file_name);

                if ($stmt->execute()) {
                    $_SESSION['success'] = "Produit ajouté avec succès.";
                } else {
                    $_SESSION['error'] = "Erreur lors de l'ajout du produit : " . htmlspecialchars($stmt->error);
                }

                $stmt->close();
            }
        } else {
            $_SESSION['error'] = "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
        }
    }

    // Rediriger après le traitement
    header("Location: add_product_form.php");
    exit();
}

include '../../templates/footer.php';
?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$page_title = "Ajouter un Produit";
include '../../config/database.php';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../css/menu-mega.css">
    <link rel="stylesheet" href="../css/add_product.css">
</head>
<body>

<div class="container">
    <h1>Ajouter un Produit</h1>

    <?php
    if (isset($_SESSION['error'])) {
        echo "<p class='error'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
        echo "<p class='success'>" . $_SESSION['success'] . "</p>";
        unset($_SESSION['success']);
    }
    ?>

    <form method="post" action="add_product.php" enctype="multipart/form-data">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required>

        <label for="prix">Prix:</label>
        <input type="number" id="prix" name="prix" required>

        <label for="couleur">Couleur:</label>
        <input type="text" id="couleur" name="couleur">

        <label for="taille">Taille:</label>
        <input type="text" id="taille" name="taille">

        <label for="matiere">Matière:</label>
        <input type="text" id="matiere" name="matiere">

        <label for="quantite">Quantité:</label>
        <input type="number" id="quantite" name="quantite" required>

        <label for="id_cat">Catégorie:</label>
        <select id="id_cat" name="id_cat" required>
            <option value="">Sélectionnez une catégorie</option>
            <?php
            $result = $conn->query("SELECT ID_cat, Nom FROM categorie");
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['ID_cat'] . '">' . $row['Nom'] . '</option>';
            }
            ?>
        </select>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" required>

        <button type="submit">Ajouter le Produit</button>
    </form>
</div>

<?php
include '../../templates/footer.php';
?>

</body>
</html>