<?php
// Verbindung zur Datenbank herstellen
$servername = "localhost"; // Name des Servers
$username = "root"; // Benutzername für die Datenbank
$password = ""; // Passwort für die Datenbank
$dbname = "bibliothek"; // Name der Datenbank

// Verbindung initialisieren
$conn = new mysqli($servername, $username, $password, $dbname);

// Prüfen, ob die Verbindung erfolgreich ist
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error); // Fehlermeldung bei Verbindungsfehler
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Büchergalerie</title>
    <link rel="stylesheet" href="bücher.css"> <!-- Einbindung des CSS-Stylesheets -->
</head>
<body>
    <!-- HEADER -->
    
    <?php include 'header.php'; ?>
    <!-- HAUPT-CONTAINER -->
    <section>
            <div class="haupt_container">
                <img src="bilder_2/container4.jpg" alt="Bücher">
            </div>
    </section>

    <div class="gelb">
        <h1>Bücher</h1>
    </div><br>  
        <!-- Abschnitt: Alle Bücher -->
    <div class="section" id="all-books">
        <h1>Alle Bücher</h1>
        <div class="gallery" id="alle-buecher">
            <?php
            // SQL-Abfrage: Auswahl aller Bücher
            $sql = "SELECT BuchID, Titel, Beschreibung, Preis, Bild FROM buecher";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $bild = !empty($row['Bild']) ? 'bilder/' . htmlspecialchars($row['Bild']) : 'bilder/platzhalter.jpg';
                    $buchId = $row['BuchID'];
                    echo '
                    <div class="gallery-item" 
                        data-id="' . $buchId . '" 
                        data-description="' . htmlspecialchars($row['Beschreibung']) . '" 
                        data-price="' . number_format($row['Preis'], 2) . '">
                        <img src="' . $bild . '" alt="' . htmlspecialchars($row['Titel']) . '">
                        <p>' . htmlspecialchars($row['Titel']) . '</p>
                        <p><strong>€' . number_format($row['Preis'], 2) . '</strong></p>
                        <div class="buttons">
                            <button class="favorite-btn">
                            <span class="heart">🤍</span>
                            </button>
                            <button class="cart-btn">🛒</button>
                        </div>
                    </div>';
                    
                    
                }
            } else {
                echo '<p>Keine Bücher gefunden!</p>';
            }
            ?>
        </div>
    </div>

    <!-- Modal für Buchdetails -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span id="close-modal" class="close-modal">&times;</span> <!-- Schließen-Button -->
            <img id="modal-image" src="" alt="Buch Bild">
            <h2 id="modal-title">Buch Titel</h2>
            <p id="modal-description">Beschreibung des Buches</p>
            <p id="modal-price"><strong>Preis:</strong> €0.00</p>
        </div>
    </div>

    <!-- Einbindung des JavaScript-Codes -->
    <script src="bücher_grid.js"></script>

    <?php
    // Verbindung schließen
    $conn->close();
    ?>

 <!-- Footer -->

<?php include 'footer.php'; ?>    

</body>
</html>
