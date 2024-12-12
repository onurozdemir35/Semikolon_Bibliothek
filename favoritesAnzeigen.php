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
$sql = "SELECT buecher.BuchID, buecher.Titel, buecher.Autor, buecher.Bild, buecher.Beschreibung, buecher.Preis FROM favorites 
        JOIN buecher ON favorites.book_id = buecher.BuchID 
        WHERE favorites.user_id = ?";
$stmt = $conn->prepare($sql); // SQL-Statement vorbereiten, um SQL-Injection zu vermeiden
$stmt->bind_param("i", $user_id); // Parameter an das Statement binden ('i' steht für Integer-Wert)
$stmt->execute(); // Statement ausführen
$result = $stmt->get_result(); // Ergebnis der Abfrage holen

// HTML-Ausgabe vorbereiten
echo "<h1>Favoriten Bücher</h1>";
echo "<div class='container'>";
echo "<div class='row'>";

// Ergebnisse durchlaufen und in Karten anzeigen
while ($row = $result->fetch_assoc()) {
    echo "<div class='col-md-4'>";
    echo "<div class='card mb-4'>";
    echo "<img src='" . htmlspecialchars($row['Bild']) . "' class='card-img-top' alt='" . htmlspecialchars($row['Titel']) . "'>";
    echo "<div class='card-body'>";
    echo "<h5 class='card-title'>" . htmlspecialchars($row['Titel']) . "</h5>";
    echo "<p class='card-text'>" . htmlspecialchars($row['Beschreibung']) . "</p>";
    echo "<p class='card-text'><strong>Preis: </strong>" . htmlspecialchars($row['Preis']) . "€</p>";
    echo "<p class='card-text'><strong>Autor: </strong>" . htmlspecialchars($row['Autor']) . "</p>";
    echo "<a href='removeFavorite.php?book_id=" . $row['BuchID'] . "' class='btn btn-danger'>Aus Favoriten entfernen</a> ";
    echo "<a href='addToCart.php?book_id=" . $row['BuchID'] . "' class='btn btn-primary'>Zum Warenkorb hinzufügen</a>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}

echo "</div>";
echo "</div>";

include 'footer.php'; // Footer einbinden

// Verbindung zur Datenbank schließen
$conn->close();
?>
