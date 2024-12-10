<?php
/* ================================================
   PHP-Logik für die Registrierung
   ================================================ */

// Sitzung starten
session_start();

// Fehlernachricht und Erfolgsnachricht initialisieren
$fehler = "";
$erfolg = "";

// Wenn das Formular abgeschickt wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Benutzereingaben filtern und validieren
    $vorname = htmlspecialchars($_POST['vorname']);
    $nachname = htmlspecialchars($_POST['nachname']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $passwort = htmlspecialchars($_POST['passwort']);

    // Checkbox Überprüfen
    if (!isset($_POST['terms'])) {
        $fehler = "Bitte akzeptieren Sie die Allgemeinen Geschäftsbedingungen (AGB), um fortzufahren.";
    } elseif (empty($vorname) || empty($nachname) || empty($email) || empty($passwort)) {
        $fehler = "Bitte füllen Sie alle Felder aus.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $fehler = "Ungültige E-Mail-Adresse.";
    } else {
        // Verbindung zur Datenbank herstellen
        $conn = new mysqli("localhost", "root", "", "test");

        // Überprüfen, ob die Verbindung erfolgreich ist
        if ($conn->connect_error) {
            $fehler = "Datenbankverbindungsfehler: " . $conn->connect_error;
        } else {
            // Überprüfen, ob die E-Mail bereits existiert
            $stmt = $conn->prepare("SELECT * FROM kunden WHERE Email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $fehler = "Diese E-Mail-Adresse ist bereits registriert.";
            } else {
                // Passwort hashen und Benutzer registrieren
                $hashed_password = password_hash($passwort, PASSWORD_BCRYPT);

                $insert_stmt = $conn->prepare("INSERT INTO kunden (Vorname, Nachname, Email, Passwort) VALUES (?, ?, ?, ?)");
                $insert_stmt->bind_param("ssss", $vorname, $nachname, $email, $hashed_password);

                if ($insert_stmt->execute()) {
                    $erfolg = "Registrierung erfolgreich! Sie werden weitergeleitet...";
                    header("refresh:3; url=header.php"); // Header.php'ye yönlendirme
                    exit();
                } else {
                    $fehler = "Es gab ein Problem bei der Registrierung. Bitte versuchen Sie es später erneut.";
                }
                $insert_stmt->close();
            }
            $stmt->close();
            $conn->close();
        }
    }
}
?>


<!-- ================================================
                  HTML-Seite
     ================================================ -->

<!DOCTYPE html>
<html lang="de">
<head>
    <title>Registrierung - Sem;kolon</title>
    <link rel="stylesheet" href="register_anmeldung.css">
</head>
<body class="page register-page">

    <!-- ================================================
             Hintergrund-Header einfügen
           ================================================ -->

    <div class="background-header">
        <?php include 'header.php'; ?>
    </div>

     <!-- ================================================
         Formularcontainer
         ================================================ -->

    <div class="form-container">
        <h1 class="form-title">Registrieren</h1>

         <!-- Fehlernachricht anzeigen, falls vorhanden -->
        <?php if ($fehler): ?>
            <div class="form-message form-message--error"><?php echo $fehler; ?></div>
        <?php endif; ?>

         <!-- Erfolgsmeldung anzeigen, falls vorhanden -->
        <?php if ($erfolg): ?>
            <div class="form-message form-message--success"><?php echo $erfolg; ?></div>
        <?php endif; ?>



        <!-- ================================================
             Registrierungsformular
             ================================================ -->
        <form class="form" method="POST" action="">
            <label class="form-label" for="vorname">Vorname</label>
            <input class="form-input" type="text" id="vorname" name="vorname" placeholder="Ihr Vorname" required>
            
            <label class="form-label" for="nachname">Nachname</label>
            <input class="form-input" type="text" id="nachname" name="nachname" placeholder="Ihr Nachname" required>
            
            <label class="form-label" for="email">E-Mail-Adresse</label>
            <input class="form-input" type="email" id="email" name="email" placeholder="Ihre E-Mail-Adresse" required>
            
            <label class="form-label" for="passwort">Passwort</label>
            <input class="form-input" type="password" id="passwort" name="passwort" placeholder="Ihr Passwort" required>
            
              <!-- Checkbox: AGB akzeptieren -->
            <div class="form-group">
                <label class="checkbox-label">
                    <input type="checkbox" name="terms" required>
                    Ich akzeptiere die <a href="https://www.hugendubel.de/de/shortcut/datenschutz" class="form-link">Datenschutz</a> & 
                                        <a href="https://www.hugendubel.de/de/shortcut/agbs" class="form-link">Allgemeinen Geschäftsbedingungen (AGB)</a>.
                </label>
            </div>

            <button type="submit" class="form-button">Registrieren</button>

        </form>
        
         <!-- Footer -->
        <div class="form-footer">
            Haben Sie schon ein Konto? <a href="anmelden.php">Anmelden</a>
        </div>
    </div>


    


</body>
</html>