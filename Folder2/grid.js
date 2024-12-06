document.addEventListener('DOMContentLoaded', () => {
   // Modal-Elemente auswählen
   const modal = document.getElementById('modal');
   const modalImage = document.getElementById('modal-image');
   const modalTitle = document.getElementById('modal-title');
   const modalDescription = document.getElementById('modal-description');
   const modalPrice = document.getElementById('modal-price');
   const closeModal = document.getElementById('close-modal');

   // Favoriten speichern
   const saveFavorites = () => {
       const favoritedItems = [...document.querySelectorAll('.favorite-btn.favorited')];
       const favoriteIds = favoritedItems.map((btn) =>
           btn.closest('.gallery-item').dataset.id
       );
       localStorage.setItem('favorites', JSON.stringify(favoriteIds));
   };

   // Favoriten aus localStorage laden
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

   // Favoriten-Logik initialisieren
   const initFavorites = () => {
       const favoriteButtons = document.querySelectorAll('.favorite-btn');
       favoriteButtons.forEach((button) => {
           button.addEventListener('click', () => {
               const heart = button.querySelector('.heart');
               const isFavorited = button.classList.toggle('favorited');
               heart.textContent = isFavorited ? '❤️' : '🤍';
               saveFavorites();
           });
       });
   };

   // Modal-Logik initialisieren
   const initModal = () => {
       const galleryItems = document.querySelectorAll('.gallery-item img');
       galleryItems.forEach((img) => {
           img.addEventListener('click', () => {
               const parent = img.closest('.gallery-item');
               const title = parent.querySelector('p').textContent;
               const description = parent.dataset.description; // Beschreibung aus data-Attribut
               const price = parent.dataset.price; // Preis aus data-Attribut

               modal.style.display = 'flex';
               modalImage.src = img.src;
               modalTitle.textContent = title;
               modalDescription.textContent = description;
               modalPrice.textContent = `Preis: €${price}`;
           });
       });

       // Modal schließen
       closeModal.addEventListener('click', () => {
           modal.style.display = 'none';
       });

       modal.style.display = 'none';
   };

   // Favoriten und Modal initialisieren
   loadFavorites();
   initFavorites();
   initModal();
});
