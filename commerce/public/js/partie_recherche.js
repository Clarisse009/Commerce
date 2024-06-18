function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

function openModal(tabName) {
    var modal = document.getElementById("myModal");
    modal.style.display = "block";
    openTab({currentTarget: document.getElementById(tabName + 'Tab')}, tabName);
}

document.getElementById("defaultOpen").click();

// Get the modal
var modal = document.getElementById("myModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Gestion de l'affichage de la section de recherche
var searchIcon = document.getElementById('searchIcon');
var searchSection = document.getElementById('searchSection');
var mainContent = document.getElementById('mainContent');

searchIcon.addEventListener('click', function() {
    searchSection.style.display = 'block';
    mainContent.style.display = 'none';
});

// Fermeture de la section de recherche
var closeSearch = document.getElementById('closeSearch');
closeSearch.addEventListener('click', function() {
    searchSection.style.display = 'none';
    mainContent.style.display = 'block';
});
