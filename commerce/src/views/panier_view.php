<?php
session_start(); // Démarrer la session

// Vérifier si le panier est vide
$panierVide = !isset($_SESSION['panier']) || count($_SESSION['panier']) === 0;
$total = 0;

// Calculer le total du panier si le panier n'est pas vide
if (!$panierVide) {
    foreach ($_SESSION['panier'] as $item) {
        $total += ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Panier</title>
    <link rel="stylesheet" href="../css/cart.css">
</head>
<body>
    <div class="cart-container">
        <div class="cart-header">
            <h1>PANIER <span class="item-count"><?php echo !$panierVide ? count($_SESSION['panier']) : 0; ?></span></h1>
            <span class="close-btn">&times;</span>
        </div>
        <hr class="divider">
        <?php if ($panierVide): ?>
            <div class="empty-cart">
                <img src="../images/empty_cart.png" alt="Panier vide">
                <h2>VOTRE PANIER EST VIDE</h2>
                <a href="../products.php" class="explore-products">Explorer nos produits</a>
            </div>
        <?php else: ?>
            <table class="cart-items">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($_SESSION['panier'] as $index => $item): ?>
                    <tr>
                        <td><img src="../images/<?php echo htmlspecialchars($item['image'] ?? 'default.jpg'); ?>" alt="<?php echo htmlspecialchars($item['name'] ?? 'Nom'); ?>" class="product-image"></td>
                        <td><?php echo htmlspecialchars($item['name'] ?? 'Nom'); ?></td>
                        <td><?php echo htmlspecialchars($item['price'] ?? 0); ?>€</td>
                        <td>
                            <div class="quantity-controls">
                                <button class="quantity-decrease" data-index="<?php echo $index; ?>">-</button>
                                <input type="number" value="<?php echo htmlspecialchars($item['quantity'] ?? 1); ?>" min="1" class="quantity-input" data-index="<?php echo $index; ?>">
                                <button class="quantity-increase" data-index="<?php echo $index; ?>">+</button>
                            </div>
                        </td>
                        <td><?php echo htmlspecialchars(($item['price'] ?? 0) * ($item['quantity'] ?? 1)); ?>€</td>
                        <td><a href="remove_from_cart.php?index=<?php echo $index; ?>" class="remove-item">Supprimer</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="cart-total">
                <h2>TOTAL</h2>
                <h3><?php echo number_format($total, 2); ?>€ EUR</h3>
            </div>
            <div class="checkout-actions">
                <button class="checkout" onclick="passerCommande()">Passer la commande</button>
                <button class="one-click-buy" onclick="acheterEnUnClic()">Acheter en 1-clic</button>
            </div>
            <div class="cart-actions">
                <button class="share-cart" onclick="partagerPanier()">Partagez votre panier</button>
            </div>
            <div class="payment-info">
                <div class="alma-logo">
                    <span>3x</span> Alma
                </div>
                <p>Paiement en 3x sans frais dès 150€ avec Alma</p>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function partagerPanier() {
            alert("Fonction de partage du panier à implémenter.");
        }

        function passerCommande() {
            window.location.href = '../checkout.php';
        }

        function acheterEnUnClic() {
            alert("Fonction d'achat en 1-clic à implémenter.");
        }

        document.querySelector('.close-btn').addEventListener('click', () => {
            alert("Fonction de fermeture du panier à implémenter.");
        });

        document.querySelectorAll('.quantity-decrease').forEach(button => {
            button.addEventListener('click', function() {
                const index = this.getAttribute('data-index');
                window.location.href = `update_quantity.php?index=${index}&action=decrease`;
            });
        });

        document.querySelectorAll('.quantity-increase').forEach(button => {
            button.addEventListener('click', function() {
                const index = this.getAttribute('data-index');
                window.location.href = `update_quantity.php?index=${index}&action=increase`;
            });
        });

        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('change', function() {
                const index = this.getAttribute('data-index');
                const quantite = this.value;
                window.location.href = `update_quantity.php?index=${index}&quantite=${quantite}`;
            });
        });

        document.querySelectorAll('.remove-item').forEach(link => {
            link.addEventListener('click', function() {
                const index = this.getAttribute('data-index');
                window.location.href = `remove_from_cart.php?index=${index}`;
            });
        });
    </script>
</body>
</html>
