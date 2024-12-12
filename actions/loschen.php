<?php
include '../includes/Verbindung.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "DELETE FROM buecher WHERE BuchID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Error um das Buch zu löschen: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "ID des Buches nicht angegeben";
}

$conn->close();
?>
