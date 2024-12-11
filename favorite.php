<?php
// Verbindung zur Datenbank herstellen
$servername = "localhost"; // Servername (meistens 'localhost')
$username = "root"; // Benutzername für die Datenbank
$password = ""; // Passwort für die Datenbank (leer für lokale Server wie XAMPP)
$dbname = "bibliothek"; // Name der Datenbank

$conn = new mysqli($servername, $username, $password, $dbname);

// Überprüfen, ob die Verbindung erfolgreich war
if ($conn->connect_error) {
    // Bei Verbindungsfehler: Fehlermeldung anzeigen und Skript beenden
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Eingabedaten verarbeiten (aus einer POST-Anfrage)
$user_id = $_POST['user_id']; // ID des angemeldeten Benutzers (z. B. aus der Session)
$book_id = $_POST['book_id']; // ID des Buches, das hinzugefügt oder entfernt werden soll
$action = $_POST['action']; // Aktion: 'add' für Hinzufügen, 'remove' für Entfernen

// Prüfen, ob die Aktion 'add' (Hinzufügen) ist
if ($action === 'add') {
    // SQL-Abfrage, um das Buch zu den Favoriten hinzuzufügen
    $sql = "INSERT INTO favorites (user_id, book_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql); // Prepared Statement erstellen
    $stmt->bind_param("ii", $user_id, $book_id); // Parameter an das Statement binden ('ii' steht für zwei Integer-Werte)

    if ($stmt->execute()) {
        // Erfolgreich hinzugefügt, JSON-Antwort mit Status 'success' zurückgeben
        echo json_encode(['status' => 'success', 'message' => 'Buch als Favorit hinzugefügt.']);
    } else {
        // Fehler beim Hinzufügen, JSON-Antwort mit Status 'error' zurückgeben
        echo json_encode(['status' => 'error', 'message' => 'Fehler beim Hinzufügen.']);
    }
    $stmt->close(); // Statement schließen
} elseif ($action === 'remove') {
    // Prüfen, ob die Aktion 'remove' (Entfernen) ist
    // SQL-Abfrage, um das Buch aus den Favoriten zu entfernen
    $sql = "DELETE FROM favorites WHERE user_id = ? AND book_id = ?";
    $stmt = $conn->prepare($sql); // Prepared Statement erstellen
    $stmt->bind_param("ii", $user_id, $book_id); // Parameter an das Statement binden

    if ($stmt->execute()) {
        // Erfolgreich entfernt, JSON-Antwort mit Status 'success' zurückgeben
        echo json_encode(['status' => 'success', 'message' => 'Buch aus Favoriten entfernt.']);
    } else {
        // Fehler beim Entfernen, JSON-Antwort mit Status 'error' zurückgeben
        echo json_encode(['status' => 'error', 'message' => 'Fehler beim Entfernen.']);
    }
    $stmt->close(); // Statement schließen
}

// Verbindung zur Datenbank schließen
$conn->close();
?>
