<?php
session_start(); // Sitzung starten

// Überprüfen, ob der Benutzer eingeloggt ist
if (!isset($_SESSION['user_id'])) {
    die("Benutzer nicht eingeloggt.");
}

// Verbindung zur Datenbank
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibliothek";

// Verbindung herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Überprüfen, ob die Verbindung erfolgreich war
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Eingabedaten von der URL
$user_id = $_SESSION['user_id'];
$book_id = $_GET['book_id'];

// SQL-Abfrage, um das Buch aus den Favoriten zu entfernen
$sql = "DELETE FROM favorites WHERE user_id = ? AND book_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $book_id);

if ($stmt->execute()) {
    // Erfolgreich entfernt, zurück zur Favoriten-Seite
    header("Location: favoritesAnzeigen.php");
} else {
    echo "Fehler beim Entfernen des Buches aus den Favoriten.";
}

$stmt->close();
$conn->close();
?>