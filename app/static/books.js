document.addEventListener('DOMContentLoaded', () => {
    fetch('/books')
        .then(response => response.json())
        .then(data => {
            const books = data.books;
            const booksList = document.getElementById('books-list');

            books.forEach(book => {
                const bookDiv = document.createElement('div');
                bookDiv.className = 'book-box';
                bookDiv.innerHTML = `
                    <h3>${book.title}</h3>
                    <p>${book.author}</p>
                    <p>Serial Number: ${book.serial_number}</p>
                    <p>Status: ${book.available ? 'Available' : 'Not Available'}</p>
                    ${book.available ? `
                        <button onclick="buyBook(${book.id})">Buy</button>
                        <button onclick="borrowBook(${book.id})">Borrow</button>
                    ` : ''}
                `;
                booksList.appendChild(bookDiv);
            });
        });
});

function buyBook(bookId) {
    fetch(`/buy_book/${bookId}`, { method: 'POST' })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.status === 'success') {
                location.reload();
            }
        });
}

function borrowBook(bookId) {
    fetch(`/borrow_book/${bookId}`, { method: 'POST' })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.status === 'success') {
                location.reload();
            }
        });
}