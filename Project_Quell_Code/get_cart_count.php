<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die(json_encode(['count' => 0]));
}

$conn = new mysqli("localhost", "root", "", "bibliothek");
if ($conn->connect_error) {
    die(json_encode(['count' => 0]));
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT SUM(quantity) AS total FROM korb WHERE KundenID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

echo json_encode(['count' => $row['total'] ?? 0]);

$stmt->close();
$conn->close();
?>