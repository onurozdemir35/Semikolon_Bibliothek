<?php
include 'header.php'; // Header einbinden
session_start(); // Sitzung starten

// Überprüfen, ob der Benutzer eingeloggt ist
if (!isset($_SESSION['user_id'])) {
    die("Benutzer nicht eingeloggt.");
}

// Verbindung zur Datenbank
$servername = "localhost"; // Servername (meistens 'localhost')
$username = "root"; // Benutzername für die Datenbank
$password = ""; // Passwort für die Datenbank (leer für lokale Server wie XAMPP)
$dbname = "bibliothek"; // Name der Datenbank

// Verbindung herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Überprüfen, ob die Verbindung erfolgreich war
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Eingabedaten von der Session
$user_id = $_SESSION['user_id']; // ID des Benutzers aus der Session

// SQL-Abfrage vorbereiten, um die Favoriten des Benutzers zu holen
$sql = "SELECT buecher.BuchID, buecher.Titel, buecher.Autor FROM favorites 
        JOIN buecher ON favorites.book_id = buecher.BuchID 
        WHERE favorites.user_id = ?";
$stmt = $conn->prepare($sql); // SQL-Statement vorbereiten, um SQL-Injection zu vermeiden
$stmt->bind_param("i", $user_id); // Parameter an das Statement binden ('i' steht für Integer-Wert)
$stmt->execute(); // Statement ausführen
$result = $stmt->get_result(); // Ergebnis der Abfrage holen

// HTML-Ausgabe vorbereiten
echo "<h1>Favoriten Bücher</h1>";
echo "<ul>";

// Ergebnisse durchlaufen und in einer Liste anzeigen
while ($row = $result->fetch_assoc()) {
    echo "<li>" . htmlspecialchars($row['Titel']) . " von " . htmlspecialchars($row['Autor']) . "</li>";
}

echo "</ul>";

include 'footer.php'; // Footer einbinden
// Verbindung zur Datenbank schließen
$conn->close();
?>
