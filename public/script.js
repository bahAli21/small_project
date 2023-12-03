//BAH MAMADOU

document.addEventListener("DOMContentLoaded", function() {
        const popup = document.querySelector('.popup');
        const links = document.querySelectorAll('.bx-link-external');

        links.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Empêche le comportement de lien par défaut

                const id = this.id;
                const span = popup.querySelector(`.popup-box .${id}`);

                if (span) {
                    // Affichons la popup
                    popup.style.display = 'flex';
                    // Affiche le span correspondant
                    span.classList.remove('hidden');
                }
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
    const popup = document.querySelector('.popup');

    // Ajoutez un gestionnaire d'événements pour masquer la popup lorsque l'utilisateur clique dedans
    popup.addEventListener('click', function(event) {
        // Vérifiez si l'élément cliqué est directement la popup (pas un enfant)
        if (event.target.classList.contains('popup')) {
            // Masque la popup
            popup.style.display = 'none';
            // Cache tous les spans
            popup.querySelectorAll('.popup-box span').forEach(span => {
                span.classList.add('hidden');
            });
        }
    });
});



// toggle icon navbar
let menuIcon = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

menuIcon.onclick = () => {
    menuIcon.classList.toggle('bx-x');
    navbar.classList.toggle('active');
}

// scroll sections
let sections = document.querySelectorAll('section');
let navLinks = document.querySelectorAll('header nav a');

// Ajout d'un gestionnaire d'événements à chaque lien
navLinks.forEach(link => {
    link.addEventListener('click', function(event) {
        // Retire la classe 'active' de tous les liens
        navLinks.forEach(link => {
            link.classList.remove('active');
        });
        event.target.classList.add('active');
    });
});


const moreButton = document.getElementById('more');
    const fullText = document.querySelector('.full-txt');

    moreButton.addEventListener('click', () => {
        fullText.style.display = 'block';
        moreButton.style.display = 'none';
    });
