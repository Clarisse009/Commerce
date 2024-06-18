document.getElementById('searchIcon').addEventListener('click', function() {
    document.getElementById('searchSection').style.display = 'block';
});

document.getElementById('closeSearch').addEventListener('click', function() {
    document.getElementById('searchSection').style.display = 'none';
});

document.getElementById('userIcon').addEventListener('click', function() {
    window.location.href = 'register.html';
});

document.getElementById('wishlistIcon').addEventListener('click', function() {
    window.location.href = 'wishlist.html';
});

document.getElementById('navToggle').addEventListener('click', function() {
    document.getElementById('navLinks').classList.toggle('active');
});

// Add event listeners for hover
document.getElementById('shoppingIcon').addEventListener('mouseover', function() {
    document.querySelector('.shopping-bag').style.display = 'block';
});

document.getElementById('shoppingIcon').addEventListener('mouseout', function() {
    document.querySelector('.shopping-bag').style.display = 'none';
});

document.getElementById('userIcon').addEventListener('mouseover', function() {
    document.querySelector('#userMenu').style.display = 'block';
});

document.getElementById('userIcon').addEventListener('mouseout', function() {
    document.querySelector('#userMenu').style.display = 'none';
});