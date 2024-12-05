<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Büchergalerie mit Favoriten</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <!-- Galerie-Container für die Buchkarten -->
    <div class="gallery">
        <?php
        // Verbindung zur Datenbank herstellen
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "bibliothek";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verbindung prüfen
        if ($conn->connect_error) {
            die("Verbindung fehlgeschlagen: " . $conn->connect_error);
        }

        // Abfrage: Nur die ersten 8 Bücher aus der Tabelle "buecher" abrufen
        $sql = "SELECT BuchID, Titel, Beschreibung, Preis, Bild FROM buecher LIMIT 8";
        $result = $conn->query($sql);

        // Wenn Ergebnisse vorhanden sind, dynamisch HTML für jedes Buch erstellen
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $bild = !empty($row['Bild']) ? 'bilder/' . htmlspecialchars($row['Bild']) : 'bilder/platzhalter.jpg';
                echo '
                <div class="gallery-item" data-id="' . $row['BuchID'] . '">
                    <h3>Buch ' . $row['BuchID'] . '</h3>
                    <img src="' . $bild . '" alt="' . htmlspecialchars($row['Titel']) . '">
                    <p>' . htmlspecialchars($row['Titel']) . '</p>
                    <button class="favorite-btn">
                        <span class="heart">🤍</span>
                    </button>
                </div>';
            }
        } else {
            echo '<p>Keine Bücher gefunden!</p>';
        }

        $conn->close();
        ?>
    </div>

    <!-- Modal für die Bildvergrößerung -->
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

    <script src="grid.js"></script>
</body>
</html>
