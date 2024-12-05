<?php
header('Content-Type: application/json');

// Verbindung zur Datenbank herstellen
$servername = "localhost";
$username = "root";
$password = ""; // Standard in XAMPP
$dbname = "bibliothek";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verbindung prüfen
if ($conn->connect_error) {
    echo json_encode(['error' => 'Verbindung fehlgeschlagen: ' . $conn->connect_error]);
    exit;
}

// Bücher aus der Tabelle abrufen
$sql = "SELECT BuchID, Titel, Beschreibung, Preis FROM buecher";
$result = $conn->query($sql);

// Ergebnis in JSON umwandeln
$books = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}

// JSON zurückgeben
echo json_encode($books);

// Verbindung schließen
$conn->close();
?>
