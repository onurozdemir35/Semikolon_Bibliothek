<?php
session_start(); // Sitzung starten
$fehler = ""; // Fehlernachricht speichern

// Wenn das Formular abgeschickt wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Benutzereingaben filtern
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // E-Mail filtern
    $passwort = htmlspecialchars($_POST['password']); // Passwort filtern

    // Überprüfen, ob die E-Mail-Adresse gültig ist
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $fehler = "Ungültiges E-Mail-Format."; // Fehlernachricht für ungültige E-Mail
    } else {
        // Mit der Datenbank verbinden
        $conn = new mysqli("localhost", "root", "", "test");

        // Überprüfen, ob die Verbindung erfolgreich ist
        if ($conn->connect_error) {
            $fehler = "Datenbankverbindungsfehler: " . $conn->connect_error; // Verbindungsfehler anzeigen
        } else {
            // Abschnitt 1: Admin-Daten überprüfen
            // SQL-Anweisung vorbereiten, um Admins zu überprüfen
            $admin_stmt = $conn->prepare("SELECT * FROM admins WHERE email = ?");
            $admin_stmt->bind_param("s", $email);
            $admin_stmt->execute();
            $admin_result = $admin_stmt->get_result();

            if ($admin_result->num_rows > 0) {
                $admin = $admin_result->fetch_assoc();
                // Passwort für Admin überprüfen
                if (password_verify($passwort, $admin['Passwort'])) {
                    $_SESSION['role'] = 'admin'; // Rolle als Admin speichern
                    $_SESSION['admin_id'] = $admin['AdminID']; // Admin-ID speichern
                    header("Location: profile.php"); // Zur Admin-Oberfläche weiterleiten
                    exit;
                } else {
                    $fehler = "Falsches Admin-Passwort!"; // Fehlermeldung für falsches Admin-Passwort
                }
            }
            $admin_stmt->close();

            // Abschnitt 2: Kunden-Daten überprüfen
            // SQL-Anweisung vorbereiten, um Kunden zu überprüfen
            $kunden_stmt = $conn->prepare("SELECT * FROM kunden WHERE Email = ?");
            $kunden_stmt->bind_param("s", $email);
            $kunden_stmt->execute();
            $kunden_result = $kunden_stmt->get_result();

            if ($kunden_result->num_rows > 0) {
                $kunde = $kunden_result->fetch_assoc();
                // Passwort für Kunde überprüfen
                if (password_verify($passwort, $kunde['Passwort'])) {
                    $_SESSION['role'] = 'customer'; // Rolle als Kunde speichern
                    $_SESSION['user_id'] = $kunde['KundenID']; // Kunden-ID speichern
                    header("Location: profile.php"); // Zur Kunden-Oberfläche weiterleiten
                    exit;
                } else {
                    $fehler = "Falsches Kunden-Passwort!"; // Fehlermeldung für falsches Kunden-Passwort
                }
            } else {
                // Wenn keine Übereinstimmung gefunden wird
                if (empty($fehler)) {
                    $fehler = "Benutzer nicht gefunden!"; // Fehler, wenn Benutzer nicht gefunden wird
                }
            }

            $kunden_stmt->close();
            $conn->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="de"> <!-- Sprache auf Deutsch setzen -->
<head>
    <title>Anmelden - Semikolon</title>
    <link rel="stylesheet" href="register_anmeldung.css"> <!-- Ortak CSS -->
</head>
<body class="page login-page"> <!-- Root class für Login -->

    <div class="background-header">
            <?php include 'header.php'; ?>
    </div>

    <div class="form-container">
        <h1 class="form-title">Anmelden</h1>

        <!-- Fehlernachricht anzeigen, falls vorhanden -->
        <?php if ($fehler): ?>
            <div class="form-message form-message--error">
                <span class="form-message__icon">⚠️</span>
                <span class="form-message__text"><?php echo $fehler; ?></span>
            </div>
        <?php endif; ?>


        <!-- Login-Formular -->
        <form class="form" method="POST" action="">
            <label class="form-label" for="email">E-Mail-Adresse</label>
            <input class="form-input" type="email" id="email" name="email" placeholder="Ihre E-Mail-Adresse" required>

            <label class="form-label" for="password">Passwort</label>
            <input class="form-input" type="password" id="password" name="password" placeholder="Ihr Passwort" required>

            <button class="form-button" type="submit">Anmelden</button>
        </form>

        <div class="form-footer">
            Noch kein Konto? <a href="registrierung.php">Registrieren</a>
        </div>
    </div>

</body>
</html>

