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

// Dummy-Benutzer-ID
//$user_id = 1;

// Benutzername abrufen
$sql_kunde = "SELECT Vorname, Nachname FROM kunden WHERE KundenID = ?";
$stmt_kunde = $conn->prepare($sql_kunde);
$stmt_kunde->bind_param("i", $user_id);
$stmt_kunde->execute();
$result_kunde = $stmt_kunde->get_result();

if ($result_kunde->num_rows > 0) {
    $row_kunde = $result_kunde->fetch_assoc();
    $kunde_name = htmlspecialchars($row_kunde['Vorname'] . " " . $row_kunde['Nachname']);
} else {
    $kunde_name = "Unbekannt";
}

// Warenkorb aktualisieren
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    if (isset($_POST['korb_id'], $_POST['quantity']) && is_array($_POST['korb_id']) && is_array($_POST['quantity'])) {
        foreach ($_POST['korb_id'] as $index => $korb_id) {
            $korb_id = intval($korb_id);
            $new_quantity = intval($_POST['quantity'][$index]);

            if ($new_quantity > 0) {
                $update_sql = "UPDATE korb SET quantity = ? WHERE KorbID = ? AND KundenID = ?";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bind_param("iii", $new_quantity, $korb_id, $user_id);
                $update_stmt->execute();
                $update_stmt->close();
            }
        }
    }
}

// Kauf abschließen
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy'])) {
    if (isset($_POST['korb_id'], $_POST['quantity']) && is_array($_POST['korb_id']) && is_array($_POST['quantity'])) {
        $conn->begin_transaction();
        try {
            foreach ($_POST['korb_id'] as $index => $korb_id) {
                $korb_id = intval($korb_id);
                $quantity = intval($_POST['quantity'][$index]);

                $sql_buch = "SELECT b.BuchID, b.Preis FROM buecher b JOIN korb k ON k.BuchID = b.BuchID WHERE k.KorbID = ? AND k.KundenID = ?";
                $stmt_buch = $conn->prepare($sql_buch);
                $stmt_buch->bind_param("ii", $korb_id, $user_id);
                $stmt_buch->execute();
                $result_buch = $stmt_buch->get_result();

                if ($result_buch->num_rows > 0) {
                    $row_buch = $result_buch->fetch_assoc();
                    $buch_id = $row_buch['BuchID'];
                    $preis = $row_buch['Preis'];
                    $betrag = $preis * $quantity;
                    $kaufdatum = date('Y-m-d');

                    $sql_kauf = "INSERT INTO kaeufe (KundenID, BuchID, Kaufdatum, Betrag) VALUES (?, ?, ?, ?)";
                    $stmt_kauf = $conn->prepare($sql_kauf);
                    $stmt_kauf->bind_param("iisd", $user_id, $buch_id, $kaufdatum, $betrag);
                    $stmt_kauf->execute();
                    $stmt_kauf->close();
                }
                $stmt_buch->close();
            }

            $delete_sql = "DELETE FROM korb WHERE KundenID = ?";
            $delete_stmt = $conn->prepare($delete_sql);
            $delete_stmt->bind_param("i", $user_id);
            $delete_stmt->execute();
            $delete_stmt->close();

            $conn->commit();
            echo "<p style='color: green;'>Der Kauf wurde erfolgreich abgeschlossen.</p>";
        } catch (Exception $e) {
            $conn->rollback();
            echo "<p style='color: red;'>Fehler beim Kaufprozess: " . $e->getMessage() . "</p>";
        }
    }
}

// Warenkorb-Daten abrufen
$sql = "SELECT k.KorbID, k.quantity, b.Titel, b.Autor, b.Preis, (k.quantity * b.Preis) AS Gesamtpreis 
        FROM korb k 
        JOIN buecher b ON k.BuchID = b.BuchID 
        WHERE k.KundenID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warenkorb</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e2f1e7;
            color: #333;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
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
        button {
            padding: 5px 10px;
            background-color: #ffcc5c;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #e1a100;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Warenkorb von <?php echo $kunde_name; ?></h1>
    <?php if ($result->num_rows > 0): ?>
        <form method="POST" action="">
            <table>
                <tr>
                    <th>Buch</th>
                    <th>Autor</th>
                    <th>Menge</th>
                    <th>Preis</th>
                    <th>Gesamtpreis</th>
                    <th>Aktion</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['Titel']); ?></td>
                        <td><?php echo htmlspecialchars($row['Autor']); ?></td>
                        <td>
                            <input type="hidden" name="korb_id[]" value="<?php echo intval($row['KorbID']); ?>">
                            <input type="number" name="quantity[]" value="<?php echo intval($row['quantity']); ?>" min="1">
                        </td>
                        <td><?php echo number_format($row['Preis'], 2); ?> €</td>
                        <td><?php echo number_format($row['Gesamtpreis'], 2); ?> €</td>
                        <td><button type="submit" name="update">Aktualisieren</button></td>
                    </tr>
                <?php endwhile; ?>
            </table>
            <div style="text-align: right; margin-right: 10%;">
                <button type="submit" name="buy">Kaufen</button>
            </div>
        </form>
    <?php else: ?>
        <p style="text-align: center;">Ihr Warenkorb ist leer.</p>
    <?php endif; ?>

<?php
$stmt->close();
$stmt_kunde->close();
$conn->close();
?>
<?php include 'footer.php'; ?>
</body>
</html>
