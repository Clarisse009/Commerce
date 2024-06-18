<?php
$page_title = "Décoration";
include '../includes/database.php';
include '../templates/header.php';

// Récupérer les produits de la catégorie Décoration depuis la base de données
$categorie_id = 4; // ID de la catégorie "Décoration"
$sql = "SELECT Id_article, Nom, Prix, Couleur, Taille, Matiere, Quantite, Description, Image FROM article WHERE ID_cat = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Erreur de préparation de la requête : " . $conn->error);
}

$stmt->bind_param('i', $categorie_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
    die("Erreur d'exécution de la requête : " . $stmt->error);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../css/index.css"> 
    <link rel="stylesheet" href="../css/footer.css"> 
    <link rel="stylesheet" href="../css/history_section.css"> 
    <link rel="stylesheet" href="../css/partie_recherche.css"> 
    <link rel="stylesheet" href="../css/menu-mega.css"> 
    <link rel="stylesheet" href="../css/acceuille.css"> 
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <script src="../js/barre_recherche.js" defer></script> 
    <script src="../js/partie_recherche.js" defer></script>
</head>
<body>

<!-- Section de recherche -->
<section id="searchSection" class="search-section">
    <div class="partie-recherche">
        <div class="croix-search">
            <input type="text" id="BarRecherche" name="BarRecherche" placeholder="Recherche...">
            <span class="close-icon" id="closeSearch">x</span>
        </div>
        <div class="Barre-cherche">
            <ul class="recherche">
                <li><a href="#collabs">NOUVEAUTÉS</a></li>
                <li><a href="#baskets">Femme</a></li>
                <li><a href="#lookbook">Homme</a></li>
                <li><a href="#manifeste">Decoration</a></li>
                <li><a href="#outlet">Promo</a></li>
            </ul>
        </div>
    </div> 
</section>

<!-- Section principale de la page Décoration -->
<section id="mainContent">
    <section id="page-nouveaute">
        <div class="acceuille-nouveautes">
            <h1>Décoration</h1>
        </div>
    </section>
   
    
    <section id="section-ronde">
        <div class="container">
            <div class="case-ronde">
                <a href="femme.html"><img src="../images/jupe2.jpg" alt="Femmes" class="img-ronde"></a>
                <div class="case-titre">
                    <h5>Femmes</h5> 
                </div>
            </div>
            <div class="case-ronde">
                <a href="homme.html"><img src="../images/chemise_homme6.jpg" alt="Hommes" class="img-ronde"></a>
                <div class="case-titre">
                    <h5>Hommes</h5>
                </div>
            </div>
            <div class="case-ronde">
                <a href="sacs.html"><img src="../images/sac3.jpg" alt="Sacs" class="img-ronde"></a>
                <div class="case-titre">
                    <h5>Sacs</h5>
                </div>
            </div>
            <div class="case-ronde">
                <a href="robes.html"><img src="../images/boucle4.jpg" alt="Robes" class="img-ronde"></a>
                <div class="case-titre">
                    <h5>Bisous</h5>
                </div>
            </div>
            <div class="case-ronde">
                <a href="chemises.html"><img src="../images/chaussure1.jpg" alt="Chemises" class="img-ronde"></a>
                <div class="case-titre">
                    <h5>chassure</h5>
                </div>
            </div>
            <div class="case-ronde">
                <a href="deco.html"><img src="../images/lampe8.jpg" alt="Déco" class="img-ronde"></a>
                <div class="case-titre">
                    <h5>Déco</h5>
                </div>
            </div>
        </div>
    </section>

    <!-- Section des produits -->
    <section id="products-section">
        <div class="product-container">
            <?php
            $count = 0;
            while ($product = $result->fetch_assoc()) {
                if ($count > 0 && $count % 4 == 0) {
                    echo '</div><div class="product-container">'; // Fermer la div précédente et en ouvrir une nouvelle toutes les 4 itérations
                }
               
                if ($count == 4) { // Ajouter la section Nouveautés après les 4 premiers produits
                    echo '</div><div class="product-container">';
                    echo '<div class="new-arrival-section">';
                    echo '<div class="new-arrival-content">';
                    echo '<h2>NOUVEAUTÉS</h2>';
                    echo '<i class="uil uil-arrow-circle-right"></i>';
                    echo '</div>';
                    echo '</div>';
                }

                echo "<div class='product'>";
                echo "<a href='../product_description.php?id_article=" . $product['Id_article'] . "'>";
                echo "<img src='../images/" . htmlspecialchars($product['Image']) . "' alt='" . htmlspecialchars($product['Nom']) . "'>";
                echo "</a>";
                echo "<div class='product-info'>";
                echo "<h2>" . htmlspecialchars($product['Nom']) . "</h2>";
                echo "<p>" . htmlspecialchars($product['Prix']) . "€</p>";
                echo "<p>" . htmlspecialchars($product['Taille']) . "</p>";
                echo "<div class='product-actions'>";
                echo "<a href='../wishlist/add_to_wishlist.php?id_article=" . $product['Id_article'] . "' class='wishlist-icon'><i class='uil uil-heart'></i></a>";
                echo "<a href='../cart/add_to_cart.php?id_article=" . $product['Id_article'] . "' class='add-to-cart-link'>acheter</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                $count++;
            }
            ?>
        </div>
    </section>
</section>



<!-- Section Newsletter -->
<section class="newsletter-section">
    <div class="newsletter-container">
        <div class="newsletter-image">
            <img src="../images/newsletter_image.jpg" alt="Inscrivez-vous à la newsletter">
        </div>
        <div class="newsletter-content">
            <h1>NEWSLETTER</h1>
            <p>Inscrivez-vous à la newsletter Panafrica et bénéficiez de -10% sur votre premier achat !</p>
            <p>Vous accéderez à des offres exclusives et les dernières actualités de Panafrica.</p>
            <form action="subscribe.php" method="post" class="newsletter-form">
                <input type="email" name="email" placeholder="E-mail" required>
                <button type="submit"><i class="uil uil-envelope"></i> Rejoindre</button>
            </form>
        </div>
    </div>
</section>

<!-- Pied de page -->
<footer class="footer-section">
    <div class="footer-container">
        <div class="footer-column">
            <h3>NOUS (RE)JOINDRE</h3>
            <ul>
                <li><a href="#">Où nous trouver ?</a></li>
                <li><a href="#">Devenir Revendeur</a></li>
                <li><a href="#">Collab x Calara</a></li>
                <li><a href="#">E-Carte Cadeau</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h3>INFOS PRATIQUES</h3>
            <ul>
                <li><a href="#">Livraison</a></li>
                <li><a href="#">Echanges & Retours</a></li>
                <li><a href="#">CGV</a></li>
                <li><a href="#">Mentions Légales</a></li>
                <li><a href="#">Demander/Suivre un retour</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>Copyright © calara, 2024.</p>
        <div class="footer-social-icons">
            <a href="#"><i class="uil uil-facebook-f"></i></a>
            <a href="#"><i class="uil uil-instagram"></i></a>
            <a href="#"><i class="uil uil-pinterest"></i></a>
        </div>
    </div>
</footer>

<?php
include '../templates/footer.php';
?>
<script>
document.getElementById("newsletterButton").addEventListener("click", function() {
    var newsletterSection = document.getElementById("newsletterSection");
    if (newsletterSection.style.display === "none") {
        newsletterSection.style.display = "block";
    } else {
        newsletterSection.style.display = "none";
    }
});
</script>

</body>

</html>
<?php
$stmt->close();
$conn->close();
?>
