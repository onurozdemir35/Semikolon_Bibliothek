<?php
include '../includes/Verbindung.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['new_title'] ?? '';
    $description = $_POST['new_description'] ?? '';
    $author = $_POST['new_author'] ?? '';
    $date = $_POST['new_date'] ?? '';
    $price = $_POST['new_price'] ?? 0.0;

    // Validar datos
    if (empty($title) || empty($description) || empty($author) || empty($date) || empty($price)) {
        echo "Alle Felder sind erfördelich .";
        exit;
    }

    $query = "INSERT INTO buecher (Titel, Beschreibung, Autor, Veroeffentlichungsdatum, Preis) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        echo "Error um das Query umzusetzen: " . $conn->error;
        exit;
    }

    $stmt->bind_param("ssssd", $title, $description, $author, $date, $price);

    if ($stmt->execute()) {
        header('Location: ../index.php'); // Redirige a la página principal
        exit;
    } else {
        echo "Error um das Buch hinzufügen: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
