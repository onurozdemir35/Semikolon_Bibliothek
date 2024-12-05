
document.addEventListener('DOMContentLoaded', async () => {
    const gallery = document.querySelector('.gallery');

    // Daten aus der Datenbank abrufen
    const fetchBooks = async () => {
        try {
            const response = await fetch('fetch_books.php');
            const books = await response.json();
            return books;
        } catch (error) {
            console.error('Fehler beim Abrufen der Bücher:', error);
        }
    };

    // Bücher in die Galerie einfügen
    const renderBooks = (books) => {
        books.forEach((book) => {
            // HTML-Struktur für jedes Buch
            const bookItem = document.createElement('div');
            bookItem.className = 'gallery-item';
            bookItem.dataset.id = book.BuchID;

            bookItem.innerHTML = `
                <img src="bilder/moodle-buch.jpg" alt="${book.Titel}">
                <h3>${book.Titel}</h3>
                <p>${book.Beschreibung}</p>
                <button class="favorite-btn">
                    <span class="heart">🤍</span>
                </button>
            `;
            gallery.appendChild(bookItem);
        });

        // Favoriten-Logik erneut initialisieren
        initFavorites();
    };

    // Favoriten-Logik
    const initFavorites = () => {
        const favoriteButtons = document.querySelectorAll('.favorite-btn');

        const saveFavorites = () => {
            const favoritedItems = [...document.querySelectorAll('.favorite-btn.favorited')];
            const favoriteIds = favoritedItems.map((btn) =>
                btn.closest('.gallery-item').getAttribute('data-id')
            );
            localStorage.setItem('favorites', JSON.stringify(favoriteIds));
        };

        const loadFavorites = () => {
            const favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            favorites.forEach((id) => {
                const button = document.querySelector(`.gallery-item[data-id="${id}"] .favorite-btn`);
                if (button) {
                    button.classList.add('favorited');
                    button.querySelector('.heart').textContent = '❤️';
                }
            });
        };

        favoriteButtons.forEach((button) => {
            button.addEventListener('click', () => {
                const heart = button.querySelector('.heart');
                const isFavorited = button.classList.toggle('favorited');
                heart.textContent = isFavorited ? '❤️' : '🤍';
                saveFavorites();
            });
        });

        loadFavorites();
    };

    // Bücher abrufen und rendern
    const books = await fetchBooks();
    if (books) {
        renderBooks(books);
    }
});
