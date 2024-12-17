<?php
// starten
session_start();


$_SESSION = array();

// beenden
session_destroy();

// zurück zur Anmeldeseite
header("Location: anmelden.php");
exit;
?>
