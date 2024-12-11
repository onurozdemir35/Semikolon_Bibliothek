// Das Formular zum Hinzufügen anzeigen
function showAddForm() {
    document.getElementById('addBookModal').style.display = 'block';
}

// Das Formular zum Hinzufügen verschwinden
function hideAddForm() {
    document.getElementById('addBookModal').style.display = 'none';
}

// Das Formular zum Bearbeiten anzeigen
function showEditForm(bookId) {
    // Ein andere Formular zum Bearbeiten verstecken
    document.querySelectorAll('.edit-row').forEach(row => row.style.display = 'none');

    // Das Formular zum Bearbeiten anzeigen
    const editRow = document.getElementById(`edit-row-${bookId}`);
    if (editRow) {
        editRow.style.display = 'table-row';
    }
}

// Das Formular zum Bearbeiten verschwinden 
function hideEditForm(bookId) {
    const editRow = document.getElementById(`edit-row-${bookId}`);
    if (editRow) {
        editRow.style.display = 'none';
    }
}

// löschen Büchern mit AJAX
function deleteBook(id) {
    if (confirm('¿Bist du sicher, das Buch zu löschen?')) {
        fetch(`actions/loschen.php?id=${id}`, {
            method: 'GET'
        })
        .then(response => response.text())
        .then(data => {
            if (data.trim() === 'success') {
                // die Spannelemente löschen
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

 // Den Button abrufen
 var mybutton = document.getElementById("scrollTopBtn");

 // Wenn der Benutzer 20px von der Oberseite des Dokuments nach unten scrollt, zeige den Button an
 window.onscroll = function() {scrollFunction()};

 function scrollFunction() {
     if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
         mybutton.style.display = "block";
     } else {
         mybutton.style.display = "none";
     }
 }

 // Wenn der Benutzer auf den Button klickt, kehrt er zum Anfang des Dokuments zurück
 function topFunction() {
     document.body.scrollTop = 0; // für Safari
     document.documentElement.scrollTop = 0; // für Chrome, Firefox, IE und Opera
     behavior: 'smooth'; // Für ein sanftes Scrollen
 }
