<?php
$page_title = "Accueil";
include '../config/database.php'; // Chemin mis à jour
include '../templates/header.php';

// Récupérer les produits depuis la base de données
$sql = "SELECT Id_article, Nom, Prix, Couleur, Taille, Matiere, Quantite, Description, Image FROM article";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../public/css/index.css"> 
    <link rel="stylesheet" href="../public/css/footer.css"> 
    <link rel="stylesheet" href="../public/css/history_section.css"> 
    <link rel="stylesheet" href="../public/css/partie_recherche.css"> 
    <link rel="stylesheet" href="../public/css/menu-mega.css"> 
    <link rel="stylesheet" href="../public/css/acceuille.css"> 
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <script src="../public/js/barre_recherche.js" defer></script> 
    <script src="../public/js/partie_recherche.js" defer></script>
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

<!-- Section principale de la page d'accueil -->
<section id="mainContent">
    <section id="page-nouveaute">
        <div class="acceuille-nouveautes">
            <h1>NOUVEAUTÉS</h1>
        </div>
    </section>
    <section id="section-ronde">
        <div class="container">
            <div class="case-ronde">
                <a href="femme.html"><img src="../public/images/jupe2.jpg" alt="Femmes" class="img-ronde"></a>
                <div class="case-titre">
                    <h5>Femmes</h5> 
                </div>
            </div>
            <div class="case-ronde">
                <a href="homme.html"><img src="../public/images/chemise_homme6.jpg" alt="Hommes" class="img-ronde"></a>
                <div class="case-titre">
                    <h5>Hommes</h5>
                </div>
            </div>
            <div class="case-ronde">
                <a href="sacs.html"><img src="../public/images/sac3.jpg" alt="Sacs" class="img-ronde"></a>
                <div class="case-titre">
                    <h5>Sacs</h5>
                </div>
            </div>
            <div class="case-ronde">
                <a href="robes.html"><img src="../public/images/boucle4.jpg" alt="Robes" class="img-ronde"></a>
                <div class="case-titre">
                    <h5>Robes</h5>
                </div>
            </div>
            <div class="case-ronde">
                <a href="chemises.html"><img src="../public/images/chaussure1.jpg" alt="Chemises" class="img-ronde"></a>
                <div class="case-titre">
                    <h5>Chaussures</h5>
                </div>
            </div>
            <div class="case-ronde">
                <a href="deco.html"><img src="../public/images/lampe8.jpg" alt="Déco" class="img-ronde"></a>
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
        // Récupérer les produits de la base de données
        $count = 0;
        while ($product = $result->fetch_assoc()) {
            if ($count == 4) { // Ajouter la section Nouveautés après les 4 premiers produits
                echo '<div class="new-arrival-section">';
                echo '<div class="new-arrival-content">';
                echo '<h2>NOUVEAUTÉS</h2>';
                echo '<p>Une nouvelle collection qui sent bon l\'été</p>';
                echo '<a href="#" class="discover-link">Découvrir <i class="uil uil-arrow-right"></i></a>';
                echo '</div></div>';
            }

            echo "<div class='product'>";
            echo "<a href='categories/product_description.php?id_article=" . $product['Id_article'] . "'>";
            echo "<img src='../public/images/" . $product['Image'] . "' alt='" . $product['Nom'] . "'>";
            echo "</a>";
            echo "<div class='product-info'>";
            echo "<h2>" . $product['Nom'] . "</h2>";
            echo "<p>" . $product['Prix'] . "€</p>";
            echo "<p>" . $product['Taille'] . "</p>";
            echo "<div class='product-actions'>";
            echo "<a href='../wishlist/add_to_wishlist.php?id_article=" . $product['Id_article'] . "' class='wishlist-icon'><i class='uil uil-heart'></i></a>";
            echo "<a href='../public/categories/panier_view.php?id_article=" . $product['Id_article'] . "' class='add-to-cart-link'>acheter</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            $count++;
        }
        ?>
    </div>
</section>





<!-- Ajoutez ici votre section similaire -->
<section class="history-section">
    <div class="history-container">
        <div class="history-image">
            <img src="../public/images/history_image.jpg" alt="L'origine de Panafrica">
        </div>
        <div class="history-content">
            <h3>L'origine de Calara</h3>
            <h1>L'HISTOIRE</h1>
            <p>Calara a été fondée en 2049, par Isabel, amis de longue date et amoureux de l’Afrique.</p>
            <p>Partis de rien et avec des rêves plein la tête, ils prennent leur sac à dos et parcourent de nombreux pays africains pour construire un projet ambitieux, engagé et humain.</p>
            <a href="#" class="btn-project">VOIR LE PROJET</a>
        </div>
    </div>
</section>

<section id="commentaires">
    <h1>Commentaires</h1>
    <div class="comment-form">
        <form action="add_comment.php" method="post">
            <input type="text" name="username" placeholder="Votre nom" required>
            <textarea name="comment" placeholder="Votre commentaire" required></textarea>
            <button type="submit">Envoyer</button>
        </form>
    </div>
    <div class="slider-container">
        <button class="prev">&#10094;</button>
        <div class="slider">
            <?php
            include '../config/database.php'; // Chemin mis à jour
            $result = $conn->query("SELECT * FROM comments ORDER BY date DESC");
            while ($row = $result->fetch_assoc()) {
                echo '<div class="review">';
                echo '<div class="rating">4.7/5</div>';
                echo '<div class="progress-bar" style="width: 94%;"></div>';
                echo '<p>' . htmlspecialchars($row['comment']) . '</p>';
                echo '<small>Avis du ' . $row['date'] . ', par ' . htmlspecialchars($row['username']) . '</small>';
                echo '</div>';
            }
            ?>
        </div>
        <button class="next">&#10095;"></button>
    </div>
</section>

<!-- Section Newsletter -->
<section class="newsletter-section">
    <div class="newsletter-container">
        <div class="newsletter-image">
            <img src="../public/images/newsletter_image.jpg" alt="Inscrivez-vous à la newsletter">
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
        <p>Copyright © Calara, 2024.</p>
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

</body>
</html>
