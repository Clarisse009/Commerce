document.querySelector('.close-btn').addEventListener('click', () => {
    alert("Fonction de fermeture du panier à implémenter.");
});

// Mise à jour de la quantité
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

// Suppression de l'article
document.querySelectorAll('.remove-item').forEach(link => {
    link.addEventListener('click', function() {
        const index = this.getAttribute('data-index');
        window.location.href = `remove_from_cart.php?index=${index}`;
    });
});
