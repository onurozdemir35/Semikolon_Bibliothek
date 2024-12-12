<?php
// Verbindung zur Datenbank
$servername = "localhost"; // Servername (meistens 'localhost')
$username = "root"; // Benutzername für die Datenbank
$password = ""; // Passwort für die Datenbank (leer für lokale Server wie XAMPP)
$dbname = "bibliothek"; // Name der Datenbank

// Verbindung herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Überprüfen, ob die Verbindung erfolgreich war
if ($conn->connect_error) {
    // Verbindung fehlgeschlagen, Fehlermeldung anzeigen und Skript beenden
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Eingabedaten von der GET-Anfrage
$user_id = $_GET['user_id']; // ID des Benutzers, der die Favoriten abfragt
$book_id = $_GET['book_id']; // ID des Buches, das überprüft werden soll

// SQL-Abfrage vorbereiten, um zu prüfen, ob das Buch in den Favoriten des Benutzers ist
$sql = "SELECT 1 FROM favorites WHERE user_id = ? AND book_id = ?";
$stmt = $conn->prepare($sql); // SQL-Statement vorbereiten, um SQL-Injection zu vermeiden
$stmt->bind_param("ii", $user_id, $book_id); // Parameter an das Statement binden ('ii' steht für zwei Integer-Werte)
$stmt->execute(); // Statement ausführen
$result = $stmt->get_result(); // Ergebnis der Abfrage holen

// Überprüfen, ob das Buch in den Favoriten des Benutzers ist
if ($result->num_rows > 0) {
    // Das Buch ist in den Favoriten, JSON-Antwort mit 'is_favorite' = true
    echo json_encode(['is_favorite' => true]);
} else {
    // Das Buch ist nicht in den Favoriten, JSON-Antwort mit 'is_favorite' = false
    echo json_encode(['is_favorite' => false]);
}

// Ressourcen freigeben
$stmt->close(); // Statement schließen
$conn->close(); // Datenbankverbindung schließen
?>
