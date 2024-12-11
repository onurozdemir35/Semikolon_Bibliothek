<?php
include '../includes/Verbindung.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['edit_id'];
    $title = $_POST['edit_title'];
    $description = $_POST['edit_description'];
    $author = $_POST['edit_author'];
    $date = $_POST['edit_date'];
    $price = $_POST['edit_price'];

    // Überprüfen Sie die Daten

    $query = "UPDATE buecher SET Titel = ?, Beschreibung = ?, Autor = ?, Veroeffentlichungsdatum = ?, Preis = ? WHERE BuchID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssdi", $title, $description, $author, $date, $price, $id);

    if ($stmt->execute()) {
        header('Location: ../index.php'); // zurück zur Hauptseite
        exit;
    } else {
        echo "Fehler um das Buch zu bearbeiten: " . $conn->error;
    }
}
?>
