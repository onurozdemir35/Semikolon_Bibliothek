<?php
session_start();

// Benutzer ist nicht eingeloggt
if (!isset($_SESSION['user_id'])) {
    header("Location: anmelden.php");
    exit;
}

// Verbindung zur Datenbank
$conn = new mysqli("localhost", "root", "", "test");

if ($conn->connect_error) {
    die("Datenbankverbindungsfehler: " . $conn->connect_error);
}

// Benutzer-ID aus der Session
$user_id = $_SESSION['user_id'];

// Benutzerdaten abrufen
$stmt = $conn->prepare("SELECT Vorname, Nachname, Email, Passwort FROM kunden WHERE KundenID = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Benutzer nicht gefunden!";
    exit;
}

// Fehlermeldungen und Erfolgsmeldungen
$error = "";
$success = "";

// Daten aktualisieren
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    // Aktuelles Passwort überprüfen
    if (!empty($current_password) && !password_verify($current_password, $user['Passwort'])) {
        $error = "Aktuelles Passwort ist falsch!";
    } else {
        // Aktualisierung
        if (!empty($new_password)) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_stmt = $conn->prepare("UPDATE kunden SET Vorname = ?, Nachname = ?, Email = ?, Passwort = ? WHERE KundenID = ?");
            $update_stmt->bind_param("ssssi", $firstname, $lastname, $email, $hashed_password, $user_id);
        } else {
            $update_stmt = $conn->prepare("UPDATE kunden SET Vorname = ?, Nachname = ?, Email = ? WHERE KundenID = ?");
            $update_stmt->bind_param("sssi", $firstname, $lastname, $email, $user_id);
        }

        if ($update_stmt->execute()) {
            $success = "Daten wurden erfolgreich aktualisiert!";
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
        } else {
            $error = "Fehler beim Aktualisieren der Daten!";
        }
        $update_stmt->close();
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="de"> <!-- Sprache auf Deutsch -->
<head>
    <title>Profil - Semikolon</title>
    <link rel="stylesheet" href="register_anmeldung.css"> <!-- Ortak CSS dosyası -->
</head>
<body class="page profile-page"> <!-- Profil için özel sınıf -->

    <!-- Flu header arkaplan -->
    <div class="background-header">
        <?php include "header.php"; ?>
    </div>

    <!-- Profil form container -->
    <div class="form-container">
        <h1 class="form-title">Profilinformationen</h1>

        <!-- Erfolg und Fehler anzeigen -->
        <?php if ($error): ?>
            <div class="form-message form-message--error"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="form-message form-message--success"><?php echo $success; ?></div>
        <?php endif; ?>

        <!-- Profil Formular -->
        <form class="form" method="POST" action="">
            <label class="form-label" for="firstname">Vorname</label>
            <input class="form-input" type="text" name="firstname" id="firstname" value="<?php echo htmlspecialchars($user['Vorname']); ?>" required>

            <label class="form-label" for="lastname">Nachname</label>
            <input class="form-input" type="text" name="lastname" id="lastname" value="<?php echo htmlspecialchars($user['Nachname']); ?>" required>

            <label class="form-label" for="email">E-Mail</label>
            <input class="form-input" type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['Email']); ?>" required>

            <label class="form-label" for="current_password">Aktuelles Passwort</label>
            <input class="form-input" type="password" name="current_password" id="current_password" placeholder="Ihr aktuelles Passwort">

            <label class="form-label" for="new_password">Neues Passwort (optional)</label>
            <input class="form-input" type="password" name="new_password" id="new_password" placeholder="Ihr neues Passwort">

            <button class="form-button" type="submit">Aktualisieren</button>
        </form>
    </div>
</body>
</html>
