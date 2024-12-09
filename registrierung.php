<?php
// Sitzung starten
session_start();

// Fehlernachricht und Erfolgsnachricht initialisieren
$fehler = "";
$erfolg = "";

// Wenn das Formular abgeschickt wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Eingaben des Benutzers filtern und bereinigen
    $vorname = htmlspecialchars($_POST['vorname']);
    $nachname = htmlspecialchars($_POST['nachname']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $passwort = htmlspecialchars($_POST['passwort']);

    // Überprüfen, ob alle Felder ausgefüllt wurden
    if (empty($vorname) || empty($nachname) || empty($email) || empty($passwort)) {
        $fehler = "Bitte füllen Sie alle Felder aus."; // Fehlermeldung, wenn ein Feld leer ist
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $fehler = "Ungültige E-Mail-Adresse."; // Fehlermeldung für ungültige E-Mail
    } else {
        // Verbindung zur Datenbank herstellen
        $conn = new mysqli("localhost", "root", "", "test");

        // Überprüfen, ob die Verbindung erfolgreich ist
        if ($conn->connect_error) {
            $fehler = "Datenbankverbindungsfehler: " . $conn->connect_error;
        } else {
            // Abschnitt 1: Überprüfen, ob die E-Mail bereits existiert
            $stmt = $conn->prepare("SELECT * FROM kunden WHERE Email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $fehler = "Diese E-Mail-Adresse ist bereits registriert."; // Fehlermeldung, wenn E-Mail existiert
            } else {
                // Abschnitt 2: Benutzer registrieren
                // Passwort hashen, um es sicher zu speichern
                $hashed_password = password_hash($passwort, PASSWORD_BCRYPT);

                // SQL-Anweisung vorbereiten, um den Benutzer in die Datenbank einzufügen
                $insert_stmt = $conn->prepare("INSERT INTO kunden (Vorname, Nachname, Email, Passwort) VALUES (?, ?, ?, ?)");
                $insert_stmt->bind_param("ssss", $vorname, $nachname, $email, $hashed_password);

                if ($insert_stmt->execute()) {
                    $erfolg = "Registrierung erfolgreich! Sie können sich jetzt einloggen."; // Erfolgsnachricht
                } else {
                    $fehler = "Es gab ein Problem bei der Registrierung. Bitte versuchen Sie es später erneut."; // Fehler bei der Registrierung
                }
                $insert_stmt->close();
            }
            $stmt->close();
            $conn->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="de"> <!-- Sprache auf Deutsch -->
<head>
    <title>Registrierung - Semikolon</title>
    <link rel="stylesheet" href="register_anmeldung.css"> <!-- Ortak CSS dosyası -->
</head>
<body class="page register-page"> <!-- Root class für Registrierung -->

    <div class="background-header">
            <?php include 'header.php'; ?>
    </div>

    <div class="form-container">
        <h1 class="form-title">Registrieren</h1>

        <!-- Fehlernachricht anzeigen -->
        <?php if ($fehler): ?>
            <div class="form-message form-message--error"><?php echo $fehler; ?></div>
        <?php endif; ?>

        <!-- Erfolgsnachricht anzeigen -->
        <?php if ($erfolg): ?>
            <div class="form-message form-message--success"><?php echo $erfolg; ?></div>
        <?php endif; ?>

        <!-- Registrierungsformular -->
        <form class="form" method="POST" action="">
            <label class="form-label" for="vorname">Vorname</label>
            <input class="form-input" type="text" id="vorname" name="vorname" placeholder="Ihr Vorname" required>

            <label class="form-label" for="nachname">Nachname</label>
            <input class="form-input" type="text" id="nachname" name="nachname" placeholder="Ihr Nachname" required>

            <label class="form-label" for="email">E-Mail-Adresse</label>
            <input class="form-input" type="email" id="email" name="email" placeholder="Ihre E-Mail-Adresse" required>

            <label class="form-label" for="passwort">Passwort</label>
            <input class="form-input" type="password" id="passwort" name="passwort" placeholder="Ihr Passwort" required>

            <button class="form-button" type="submit">Registrieren</button>
        </form>
        <div class="form-footer">
            Haben Sie schon ein Konto? <a href="anmelden.php">Anmelden</a>
        </div>
    </div>
</body>
</html>

