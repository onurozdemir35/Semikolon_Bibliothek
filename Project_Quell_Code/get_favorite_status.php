<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die(json_encode(['status' => 'error', 'message' => 'Benutzer nicht angemeldet']));
}

$user_id = $_SESSION['user_id'];

$conn = new mysqli("localhost", "root", "", "bibliothek");
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Datenbankverbindung fehlgeschlagen']));
}

$sql = "SELECT BuchID FROM favorites WHERE KundenID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$favorites = [];
while ($row = $result->fetch_assoc()) {
    $favorites[] = $row['BuchID'];
}

echo json_encode(['status' => 'success', 'favorites' => $favorites]);

$stmt->close();
$conn->close();
?>
