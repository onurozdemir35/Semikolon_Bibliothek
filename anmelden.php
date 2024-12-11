<?php
session_start(); // Sitzung starten

/* --------------------------------------------
 * Fehlernachricht und Variablen vorbereiten
 * --------------------------------------------
 */
$fehler = ""; // Fehlernachricht initialisieren

// Wenn das Formular abgeschickt wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Benutzereingaben bereinigen
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // E-Mail bereinigen
    $passwort = htmlspecialchars($_POST['password']); // Passwort bereinigen

    /* --------------------------------------------
     * E-Mail-Validierung
     * --------------------------------------------
     */
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $fehler = "Ungültiges E-Mail-Format."; // Ungültige E-Mail-Fehlernachricht
    } else {
        // Datenbankverbindung aufbauen
        $conn = new mysqli("localhost", "root", "", "bibliothek");

        /* --------------------------------------------
         * Datenbankverbindung prüfen
         * --------------------------------------------
         */
        if ($conn->connect_error) {
            $fehler = "Datenbankverbindungsfehler: " . $conn->connect_error; // Fehler anzeigen
        } else {
            /* --------------------------------------------
             * Admin-Daten validieren
             * --------------------------------------------
             */
            $admin_stmt = $conn->prepare("SELECT * FROM admins WHERE email = ?");
            $admin_stmt->bind_param("s", $email);
            $admin_stmt->execute();
            $admin_result = $admin_stmt->get_result();

            if ($admin_result->num_rows > 0) {
                $admin = $admin_result->fetch_assoc();
                if (password_verify($passwort, $admin['Passwort'])) {
                    $_SESSION['role'] = 'admin'; // Admin-Rolle speichern
                    $_SESSION['admin_id'] = $admin['AdminID']; // Admin-ID speichern
                    header("Location: bücher.php"); // Weiterleitung zur Admin-Seite
                    exit;
                } else {
                    $fehler = "Falsches Admin-Passwort!";
                }
            }
            $admin_stmt->close();

            /* --------------------------------------------
             * Kunden-Daten validieren
             * --------------------------------------------
             */
            $kunden_stmt = $conn->prepare("SELECT * FROM kunden WHERE Email = ?");
            $kunden_stmt->bind_param("s", $email);
            $kunden_stmt->execute();
            $kunden_result = $kunden_stmt->get_result();

            if ($kunden_result->num_rows > 0) {
                $kunde = $kunden_result->fetch_assoc();
                if (password_verify($passwort, $kunde['Passwort'])) {
                    $_SESSION['role'] = 'customer'; // Kunden-Rolle speichern
                    $_SESSION['user_id'] = $kunden['KundenID']; // Kunden-ID speichern
                    header("Location: header.php"); // Weiterleitung zur Kunden-Seite
                    exit;
                } else {
                    $fehler = "Falsches Kunden-Passwort!";
                }
            } else {
                if (empty($fehler)) {
                    $fehler = "Benutzer nicht gefunden!";
                }
            }

            $kunden_stmt->close();
            $conn->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>Anmelden - Semikolon</title>
    <!-- CSS-Datei einbinden -->
    <link rel="stylesheet" href="register_anmeldung.css">
</head>
<body class="page login-page"> <!-- Klasse für Login-Seite -->

    <!-- =============================================
         Hintergrund-Header mit Blur-Effekt
         ============================================= -->
    <div class="background-header">
        <?php include 'header.php'; ?>
    </div>

    <!-- =============================================
         Formularbereich
         ============================================= -->
    <div class="form-container">
        <h1 class="form-title">Anmelden</h1>

        <!-- Fehlernachricht anzeigen -->
        <?php if ($fehler): ?>
            <div class="form-message form-message--error" role="alert">
                <span class="form-message__icon">⚠️</span>
                <span class="form-message__text"><?php echo $fehler; ?></span>
            </div>
        <?php endif; ?>

        <!-- **Anmeldeformular** -->
        <form class="form" method="POST" action="">
            <label class="form-label" for="email">E-Mail-Adresse</label>
            <input class="form-input" type="email" id="email" name="email" placeholder="Ihre E-Mail-Adresse" required>

            <label class="form-label" for="password">Passwort</label>
            <input class="form-input" type="password" id="password" name="password" placeholder="Ihr Passwort" required>

            <button class="form-button" type="submit">Anmelden</button>
        </form>

        <!-- =============================================
             Fußzeile mit Links
             ============================================= -->
        <div class="form-footer">
            Noch kein Konto? <a href="registrierung.php">Registrieren</a>
        </div>
    </div>

</body>
</html>
