// JavaScript: Bücher Grid
// Steuert Favoriten-, Warenkorb-Buttons und Modal-Darstellung
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('modal');
    const modalImage = document.getElementById('modal-image');
    const modalDescription = document.getElementById('modal-description');
    const modalPrice = document.getElementById('modal-price');
    const closeModal = document.getElementById('close-modal');
    const cartCount = document.getElementById('cart-count');

    // Funktion: Modal anzeigen
    function showModal(image, description, price) {
        if (modal && modalImage && modalDescription && modalPrice) {
            modalImage.src = image;
            modalDescription.textContent = description;
            modalPrice.textContent = `Preis: €${parseFloat(price).toFixed(2)}`;
            modal.style.display = 'block';
        } else {
            console.error('Modal-Elemente nicht gefunden.');
        }
    }

    // Modal schließen
    if (closeModal) {
        closeModal.addEventListener('click', () => {
            if (modal) modal.style.display = 'none';
        });
    }

    window.addEventListener('click', (event) => {
        if (modal && event.target === modal) modal.style.display = 'none';
    });

    // Favoriten laden und UI aktualisieren
    function loadFavorites() {
        fetch('get_favorite_status.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP-Error: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    updateFavoritesUI(data.favorites || []);
                } else {
                    console.warn(data.message || 'Favoriten konnten nicht abgerufen werden.');
                }
            })
            .catch(error => console.error('Fehler beim Abrufen der Favoriten:', error));
    }
    

    // Favoriten-UI aktualisieren
    function updateFavoritesUI(favorites) {
        document.querySelectorAll('.gallery-item').forEach(item => {
            const bookId = parseInt(item.getAttribute('data-id'), 10);
            const heart = item.querySelector('.heart');
            if (heart) {
                heart.textContent = favorites.includes(bookId) ? '❤️' : '🤍';
            } else {
                console.warn('Favoriten-Icon nicht gefunden für BuchID:', bookId);
            }
        });
    }

    // Favoritenstatus ändern
    document.querySelectorAll('.favorite-btn').forEach(button => {
        const galleryItem = button.closest('.gallery-item');
        const bookId = galleryItem ? galleryItem.getAttribute('data-id') : null;
        const heart = button.querySelector('.heart');

        button.addEventListener('click', async (event) => {
            event.stopPropagation();
            if (!heart || !bookId) return;

            const isFavorited = heart.textContent === '❤️';
            const action = isFavorited ? 'remove' : 'add';

            try {
                const response = await fetch('favorite.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `BuchID=${bookId}&action=${action}`
                });
                const data = await response.json();

                if (data.status === 'success') {
                    heart.textContent = action === 'add' ? '❤️' : '🤍';
                } else {
                    console.error('Fehler bei der Favoritenaktualisierung:', data.message);
                }
            } catch (error) {
                console.error('Netzwerk- oder Serverfehler:', error);
            }
        });
    });

    // Buch zum Warenkorb hinzufügen
    document.querySelectorAll('.cart-btn').forEach(button => {
        const galleryItem = button.closest('.gallery-item');
        const bookId = galleryItem ? galleryItem.getAttribute('data-id') : null;

        button.addEventListener('click', async (event) => {
            event.stopPropagation();
            if (!bookId) return;

            try {
                const response = await fetch('add_to_cart.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `BuchID=${bookId}`
                });
                const data = await response.json();

                if (data.status === 'success') {
                    alert('Das Buch wurde dem Warenkorb hinzugefügt!');
                    updateCartCount();
                } else {
                    console.error('Fehler beim Hinzufügen zum Warenkorb:', data.message);
                }
            } catch (error) {
                console.error('Netzwerk- oder Serverfehler:', error);
            }
        });
    });

    // Warenkorb-Zähler aktualisieren
    async function updateCartCount() {
        if (!cartCount) {
            console.warn('Element mit der ID "cart-count" wurde nicht gefunden.');
            return;
        }

        try {
            const response = await fetch('get_cart_count.php');
            const data = await response.json();
            const count = data.count || 0;

            cartCount.textContent = count;
            cartCount.style.display = count > 0 ? 'block' : 'none';
        } catch (error) {
            console.error('Fehler beim Abrufen des Warenkorbzählers:', error);
        }
    }

    // Klick-Logik für Galerie-Elemente (Modal anzeigen)
    document.querySelectorAll('.gallery-item').forEach(item => {
        item.addEventListener('click', (event) => {
            const isHeartClicked = event.target.classList.contains('heart');
            const isCartClicked = event.target.classList.contains('cart-btn');
            if (isHeartClicked || isCartClicked) return;

            const image = item.querySelector('img') ? item.querySelector('img').src : null;
            const description = item.getAttribute('data-description');
            const price = item.getAttribute('data-price');

            if (image && description && price) {
                showModal(image, description, price);
            } else {
                console.warn('Unvollständige Daten für das Modal.');
            }
        });
    });

    // Initialisierung: Favoriten und Warenkorb laden
    loadFavorites();
    updateCartCount();
});
