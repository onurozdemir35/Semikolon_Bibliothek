document.addEventListener('DOMContentLoaded', () => {
   const modal = document.getElementById('modal'); // Modal-Element
   const modalImage = document.getElementById('modal-image'); // Bild im Modal
   const modalTitle = document.getElementById('modal-title'); // Titel im Modal
   const modalDescription = document.getElementById('modal-description'); // Beschreibung im Modal
   const modalPrice = document.getElementById('modal-price'); // Preis im Modal
   const closeModal = document.getElementById('close-modal'); // Schließen-Button im Modal

   const saveFavorites = () => {
       const favoritedItems = [...document.querySelectorAll('.favorite-btn.favorited')];
       const favoriteIds = favoritedItems.map((btn) =>
           btn.closest('.gallery-item').dataset.id
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

   const initModal = () => {
       const galleryItems = document.querySelectorAll('.gallery-item img');
       galleryItems.forEach((img) => {
           img.addEventListener('click', () => {
               const parent = img.closest('.gallery-item');
               const title = parent.querySelector('p').textContent;
               const description = parent.dataset.description; // Beschreibung aus data-Attribut
               const price = parent.dataset.price; // Preis aus data-Attribut

               modal.style.display = 'flex'; // Modal sichtbar machen
               modalImage.src = img.src; // Bild im Modal setzen
               modalTitle.textContent = title; // Titel im Modal setzen
               modalDescription.textContent = description; // Beschreibung im Modal setzen
               modalPrice.textContent = `Preis: €${price}`; // Preis im Modal setzen
           });
       });

       closeModal.addEventListener('click', () => {
           modal.style.display = 'none'; // Modal ausblenden
       });

       modal.style.display = 'none';
   };

   loadFavorites();
   initFavorites();
   initModal();
});
