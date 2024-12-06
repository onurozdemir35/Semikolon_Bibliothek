<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Büchergalerie mit Favoriten</title>
    <!-- Verknüpfen der CSS-Datei -->
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <!-- Galerie-Container -->
    <div class="gallery">
        <?php
        // Verbindung zur Datenbank herstellen
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "bibliothek";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verbindung prüfen und Fehlermeldung ausgeben, falls fehlgeschlagen
        if ($conn->connect_error) {
            die("Verbindung fehlgeschlagen: " . $conn->connect_error);
        }

        // SQL-Abfrage: Holen Sie sich die ersten 8 Bücher aus der Datenbank
        $sql = "SELECT BuchID, Titel, Beschreibung, Preis, Bild FROM buecher LIMIT 8";
        $result = $conn->query($sql);

        // Überprüfen, ob Ergebnisse zurückgegeben wurden
        if ($result->num_rows > 0) {
            // Durch die Ergebnisse iterieren und HTML für jedes Buch generieren
            while ($row = $result->fetch_assoc()) {
                // Überprüfen, ob ein Bild vorhanden ist, ansonsten Platzhalterbild verwenden
                $bild = !empty($row['Bild']) ? 'bilder/' . htmlspecialchars($row['Bild']) : 'bilder/platzhalter.jpg';
                echo '
                <div class="gallery-item" 
                     data-id="' . $row['BuchID'] . '" 
                     data-description="' . htmlspecialchars($row['Beschreibung']) . '" 
                     data-price="' . $row['Preis'] . '">
                    <h3>Buch ' . $row['BuchID'] . '</h3>
                    <img src="' . $bild . '" alt="' . htmlspecialchars($row['Titel']) . '">
                    <p>' . htmlspecialchars($row['Titel']) . '</p>
                    <button class="favorite-btn">
                        <span class="heart">🤍</span>
                    </button>
                </div>';
            }
        } else {
            // Nachricht anzeigen, falls keine Bücher gefunden wurden
            echo '<p>Keine Bücher gefunden!</p>';
        }

        // Verbindung zur Datenbank schließen
        $conn->close();
        ?>
    </div>

    <!-- Modal für das Vergrößern der Buchinformationen -->
    <div class="modal" id="modal">
        <div class="modal-content">
            <img id="modal-image" src="" alt="">
            <div class="modal-info">
                <h3 id="modal-title"></h3>
                <p id="modal-description"></p>
                <p id="modal-price"></p>
            </div>
            <button id="close-modal">Schließen</button>
        </div>
    </div>

    <!-- Verknüpfen der JavaScript-Datei -->
    <script src="grid.js"></script>
</body>
</html>
