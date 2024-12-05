document.addEventListener('DOMContentLoaded', () => {
    const gallery = document.querySelector('.gallery'); // Galerie-Container
    const modal = document.getElementById('modal'); // Modal-Element
    const modalImage = document.getElementById('modal-image'); // Bild im Modal
    const modalTitle = document.getElementById('modal-title'); // Titel im Modal
    const modalDescription = document.getElementById('modal-description'); // Beschreibung im Modal
    const modalPrice = document.getElementById('modal-price'); // Preis im Modal
    const closeModal = document.getElementById('close-modal'); // Schließen-Button im Modal

    // Funktion: Favoriten in localStorage speichern
    const saveFavorites = () => {
        const favoritedItems = [...document.querySelectorAll('.favorite-btn.favorited')]; // Alle favorisierten Buttons
        const favoriteIds = favoritedItems.map((btn) =>
            btn.closest('.gallery-item').dataset.id // Buch-ID extrahieren
        );
        localStorage.setItem('favorites', JSON.stringify(favoriteIds)); // Favoriten in localStorage speichern
    };

    // Funktion: Favoriten aus localStorage laden
    const loadFavorites = () => {
        const favorites = JSON.parse(localStorage.getItem('favorites')) || []; // Favoriten abrufen
        favorites.forEach((id) => {
            const button = document.querySelector(`.gallery-item[data-id="${id}"] .favorite-btn`);
            if (button) {
                button.classList.add('favorited'); // Favoritenstatus wiederherstellen
                button.querySelector('.heart').textContent = '❤️'; // Gefülltes Herz anzeigen
            }
        });
    };

    // Funktion: Favoritenlogik initialisieren
    const initFavorites = () => {
        const favoriteButtons = document.querySelectorAll('.favorite-btn');
        favoriteButtons.forEach((button) => {
            button.addEventListener('click', () => {
                const heart = button.querySelector('.heart');
                const isFavorited = button.classList.toggle('favorited'); // Favoritenstatus umschalten
                heart.textContent = isFavorited ? '❤️' : '🤍'; // Herzsymbol aktualisieren
                saveFavorites(); // Favoriten speichern
            });
        });
    };

    // Funktion: Modal-Logik initialisieren
    const initModal = () => {
        const galleryItems = document.querySelectorAll('.gallery-item img'); // Alle Buchbilder auswählen
        galleryItems.forEach((img) => {
            img.addEventListener('click', () => {
                const parent = img.closest('.gallery-item'); // Eltern-Element der Buchkarte
                modal.style.display = 'flex'; // Modal sichtbar machen
                modalImage.src = img.src; // Bild im Modal setzen
                modalTitle.textContent = parent.querySelector('p').textContent; // Titel setzen
                modalDescription.textContent = "Hier könnte eine Beschreibung stehen."; // Beispielbeschreibung
                modalPrice.textContent = "Preis: €" + (Math.random() * 100).toFixed(2); // Beispielpreis
            });
        });

        // Modal schließen
        closeModal.addEventListener('click', () => {
            modal.style.display = 'none'; // Modal ausblenden
        });

        // Sicherstellen, dass das Modal beim Laden der Seite unsichtbar ist
        modal.style.display = 'none';
    };

    // Initialisierung der Funktionen
    loadFavorites(); // Favoritenstatus beim Laden der Seite wiederherstellen
    initFavorites(); // Favoritenlogik aktivieren
    initModal(); // Modal-Logik aktivieren
});
