// Das Formular zum Bearbeiten anzeigen
function showEditForm(bookId) {
    // Ein anderes Formular zum Bearbeiten verstecken
    document.querySelectorAll('.edit-row').forEach(row => row.style.display = 'none');

    // Das entsprechende Formular anzeigen
    const editRow = document.getElementById(`edit-row-${bookId}`);
    if (editRow) {
        editRow.style.display = 'table-row';
    }
}

// Das Formular zum Bearbeiten verstecken
function hideEditForm(bookId) {
    const editRow = document.getElementById(`edit-row-${bookId}`);
    if (editRow) {
        editRow.style.display = 'none';
    }
}

// Das Modal zum Hinzufügen eines neuen Buches anzeigen
function showAddForm() {
    // Das Formular im Modal leeren
    document.getElementById('modal-title').innerText = 'Buch einfügen';
    document.getElementById('book-id').value = '';
    document.getElementById('title').value = '';
    document.getElementById('description').value = '';
    document.getElementById('author').value = '';
    document.getElementById('date').value = '';
    document.getElementById('price').value = '';

    // Das Modal anzeigen
    document.getElementById('addBookModal').style.display = 'block';
}

// Das Modal zum Hinzufügen eines neuen Buches verstecken
function hideAddForm() {
    document.getElementById('addBookModal').style.display = 'none';
}

// Das Modal zum Bearbeiten eines Buches anzeigen
function showEditModal(bookId) {
    // Das Formular im Modal mit den Daten des Buches füllen
    const row = document.getElementById(`row-${bookId}`);
    const title = row.children[1].innerText;
    const description = row.children[2].innerText;
    const author = row.children[3].innerText;
    const date = row.children[4].innerText;
    const price = row.children[5].innerText;

    document.getElementById('modal-title').innerText = 'Buch bearbeiten';
    document.getElementById('book-id').value = bookId;
    document.getElementById('title').value = title;
    document.getElementById('description').value = description;
    document.getElementById('author').value = author;
    document.getElementById('date').value = date;
    document.getElementById('price').value = price;

    // Das Modal anzeigen
    document.getElementById('editBookModal').style.display = 'block';
}

// Das Modal zum Bearbeiten eines Buches verstecken
function hideEditModal() {
    document.getElementById('editBookModal').style.display = 'none';
}

// Eliminar libro usando AJAX
function deleteBook(id) {
    if (confirm('¿Bist du sicher das Buch zu löschen?')) {
        fetch(`actions/loschen.php?id=${id}`, {
            method: 'GET'
        })
        .then(response => response.text())
        .then(data => {
            if (data === 'success') {
                // Eliminar la fila de la tabla
                document.getElementById(`row-${id}`).remove();
                document.getElementById(`edit-row-${id}`).remove();
                alert('Buch erfolgreich gelöscht');
            } else {
                alert('Fehler um das Buch zu löschen: ' + data);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Fehler um das Buch zu löschen');
        });
    }
}

// Event listener para cerrar el modal cuando se hace clic fuera de él
window.onclick = function(event) {
    const modal = document.getElementById('modal');
    if (event.target === modal) {
        closeModal();
    }
}