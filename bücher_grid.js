document.addEventListener('DOMContentLoaded', () => {
    // Referenzen für das Modal
    // Zugriff auf die Elemente des Modal-Fensters und deren Inhalte
    const modal = document.getElementById('modal');
    const modalImage = document.getElementById('modal-image');
    const modalTitle = document.getElementById('modal-title');
    const modalDescription = document.getElementById('modal-description');
    const modalPrice = document.getElementById('modal-price');
    const closeModal = document.getElementById('close-modal');

    // Modal schließen, wenn der "Schließen"-Button angeklickt wird
    closeModal.addEventListener('click', () => {
        modal.style.display = 'none'; // Modal unsichtbar machen
    });

    // Modal schließen, wenn außerhalb des Modal-Inhalts geklickt wird
    window.addEventListener('click', (event) => {
        if (event.target === modal) { // Prüfen, ob der Klick außerhalb des Modals war
            modal.style.display = 'none'; // Modal schließen
        }
    });

    // Klick-Logik für jedes Galerie-Item
    document.querySelectorAll('.gallery-item').forEach(item => {
        item.addEventListener('click', (event) => {
            // Prüfen, ob das Herz-Icon (Favoriten) angeklickt wurde
            const isHeartClicked = event.target.classList.contains('heart');
            if (isHeartClicked) return; // Keine Modalöffnung, wenn Herz angeklickt wurde

            // Modal-Daten aktualisieren
            const image = item.querySelector('img').src; // Bildquelle auslesen
            const title = item.querySelector('h3').textContent; // Titel auslesen
            const description = item.getAttribute('data-description'); // Beschreibung aus Attribut
            const price = item.getAttribute('data-price'); // Preis aus Attribut

            modalImage.src = image; // Bild im Modal aktualisieren
            modalTitle.textContent = title; // Titel im Modal aktualisieren
            modalDescription.textContent = description; // Beschreibung aktualisieren
            modalPrice.textContent = `Preis: €${parseFloat(price).toFixed(2)}`; // Preis formatieren und anzeigen

            // Modal anzeigen
            modal.style.display = 'block'; // Modal sichtbar machen
        });
    });

    document.querySelectorAll('.favorite-btn').forEach(button => {
        const galleryItem = button.closest('.gallery-item');
        const buchId = galleryItem.getAttribute('data-id');
        const heart = button.querySelector('.heart');
        const userId = 1; // Beispiel: Benutzer-ID aus der Session oder einer globalen Variable
    
        // Initialisieren: Status vom Server holen
        fetch(`get_favorite_status.php?user_id=${userId}&book_id=${buchId}`)
            .then(response => response.json())
            .then(data => {
                if (data.is_favorite) {
                    heart.textContent = '❤️';
                } else {
                    heart.textContent = '🤍';
                }
            });
    
        // Klick auf den Favoriten-Button
        button.addEventListener('click', (event) => {
            event.stopPropagation(); // Verhindert Modalöffnung
    
            const isFavorited = heart.textContent === '❤️';
            const action = isFavorited ? 'remove' : 'add';
    
            // API-Aufruf für Favoritenstatus
            fetch('favorite.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `user_id=${userId}&book_id=${buchId}&action=${action}`,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        if (action === 'add') {
                            heart.textContent = '❤️'; // Markieren
                        } else {
                            heart.textContent = '🤍'; // Entfernen
                        }
                    } else {
                        alert(data.message); // Fehler anzeigen
                    }
                });
        });
    });
    

    // Toggle-Button für "Alle Bücher einblenden"
    const toggleButton = document.getElementById('toggle-books-btn'); // Referenz zum Toggle-Button
    const allBooksSection = document.getElementById('alle-buecher'); // Referenz zur Sektion mit allen Büchern

    toggleButton.addEventListener('click', () => {
        // Sichtbarkeit umschalten
        if (allBooksSection.style.display === 'none') { // Prüfen, ob die Sektion aktuell versteckt ist
            allBooksSection.style.display = 'grid'; // Einblenden
            toggleButton.textContent = 'Alle Bücher ausblenden'; // Button-Text ändern
        } else {
            allBooksSection.style.display = 'none'; // Ausblenden
            toggleButton.textContent = 'Alle Bücher einblenden'; // Button-Text ändern
        }
    });
});
