<?php
//Datenbank verbindung
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'bibliothek';


$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die('Verbindung fehlgeschlagen: ' . $conn->connect_error);
}


?>
