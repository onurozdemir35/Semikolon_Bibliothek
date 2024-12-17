<?php
session_start();

// Prüfen, ob der Benutzer angemeldet ist
if (!isset($_SESSION['user_id'])) {
    die(json_encode(['status' => 'error', 'message' => 'Benutzer nicht angemeldet.']));
}

$user_id = $_SESSION['user_id'];
$buch_id = intval($_POST['BuchID'] ?? 0);
$quantity = intval($_POST['quantity'] ?? 1);

// Datenbankverbindung herstellen
$conn = new mysqli("localhost", "root", "", "bibliothek");
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Datenbankverbindung fehlgeschlagen.']));
}

// Prüfen, ob das Buch bereits im Warenkorb ist
$sql_check = "SELECT * FROM korb WHERE KundenID = ? AND BuchID = ?";
$stmt = $conn->prepare($sql_check);
$stmt->bind_param("ii", $user_id, $buch_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Menge aktualisieren
    $sql_update = "UPDATE korb SET quantity = quantity + ? WHERE KundenID = ? AND BuchID = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("iii", $quantity, $user_id, $buch_id);
    if ($stmt_update->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Menge aktualisiert.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Fehler beim Aktualisieren der Menge.']);
    }
    $stmt_update->close();
} else {
    // Neues Buch in den Warenkorb einfügen
    $sql_insert = "INSERT INTO korb (KundenID, BuchID, quantity) VALUES (?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("iii", $user_id, $buch_id, $quantity);
    if ($stmt_insert->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Zum Warenkorb hinzugefügt.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Fehler beim Hinzufügen zum Warenkorb.']);
    }
    $stmt_insert->close();
}

// Ressourcen freigeben
$stmt->close();
$conn->close();
?>
