<?php
// Header einbinden
include 'header.php';


// Verbindung zur Datenbank herstellen
$conn = new mysqli("localhost", "root", "", "Bibliothek");
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}
$conn->set_charset("utf8");

// Session starten und Benutzer-ID überprüfen
session_start();
$user_id = $_SESSION['user_id'] ?? null;

// Benutzer-ID manuell für Testzwecke


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Bibliothek";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

$conn->set_charset("utf8");

// Benutzerinformationen abrufen
$stmt_kunde = $conn->prepare("SELECT Vorname, Nachname FROM kunden WHERE KundenID = ?");
$stmt_kunde->bind_param("i", $user_id);
$stmt_kunde->execute();
$result_kunde = $stmt_kunde->get_result();

if ($result_kunde->num_rows > 0) {
    $row_kunde = $result_kunde->fetch_assoc();
    $kunde_name = htmlspecialchars($row_kunde['Vorname'] . " " . $row_kunde['Nachname']);
} else {
    $kunde_name = "Unbekannt";
}

// Bestellungen abrufen
$stmt_bestellungen = $conn->prepare("
    SELECT k.KaufID, k.BuchID, k.Kaufdatum, k.Betrag, b.Titel 
    FROM kaeufe k
    JOIN buecher b ON k.BuchID = b.BuchID
    WHERE k.KundenID = ?
    ORDER BY k.Kaufdatum DESC
");
$stmt_bestellungen->bind_param("i", $user_id);
$stmt_bestellungen->execute();
$result = $stmt_bestellungen->get_result();

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kundenprofil - Bestellungen</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #e2f1e7;
            color: #333;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        table, th, td {
            border: 1px solid #ddd;
            text-align: center;
        }
        th, td {
            padding: 10px;
        }
        th {
            background-color: #f4f4f4;
        }
        input[type='number'] {
            width: 50px;
            text-align: center;
        }
        button {
            padding: 5px 10px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Bestellungen von <?php echo $kunde_name; ?></h1>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>KaufID</th>
                <th>Buchtitel</th>
                <th>Kaufdatum</th>
                <th>Betrag (€)</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['KaufID']); ?></td>
                    <td><?php echo htmlspecialchars($row['Titel']); ?></td>
                    <td><?php echo htmlspecialchars($row['Kaufdatum']); ?></td>
                    <td><?php echo number_format(htmlspecialchars($row['Betrag']), 2, ',', '.'); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p class="no-orders">Keine Bestellungen gefunden.</p>
    <?php endif; ?>

    <?php
    // Footer einbinden
    include 'footer.php';
    ?>

</body>
</html>

<?php
$stmt_kunde->close();
$stmt_bestellungen->close();
$conn->close();
?>
