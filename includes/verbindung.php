
<?php
//Datos de acceso a la base de datos
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'bibliothek';


//Create conexión 
$conn = new mysqli($host, $username, $password, $database);

//Check connection
if ($conn->connect_error) {
    die('Verbindung fehlgeschlagen: ' . $conn->connect_error);
}

?>
