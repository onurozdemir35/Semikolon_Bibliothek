<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEST-PHP</title>
</head>
<body>

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

<table>
    <tr>
        <th style="font-weight: 500;">Titel</th>
        <th style="font-weight: 500;">Beschreibung</th>
        <th style="font-weight: 500;">Autor</th>
        <th style="font-weight: 500;">Veroeffentlichungsdatum</th>
        <th style="font-weight: 500;">Preis</th>
    </tr>
    <br>

<?php
//Anfrage

$query = 'SELECT * FROM buecher';

$result = $conn->query($query);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()) {
        //Datos en tabla de html
        echo "<tr>";
        echo "<td>" . $row['BuchID'] . "</td>";
        echo "<td>" . $row['Titel'] . "</td>";
        echo "<td>" . $row['Beschreibung'] . "</td>";
        echo "<td>" . $row['Autor'] . "</td>";
        echo "<td>" . $row['Veroeffentlichungsdatum'] . "</td>";
        echo "<td>" . $row['Preis'] . "</td>";
        echo "</tr>";       
     
    }

}
//Insert into (Neues Buch wird vom Admin in der Datenbank hinzugefügt)   
?>
<br><br><br><br><br>
</table>
<form action="" method="post">
    <input type="text " name="Titel" id="" placeholder="Titel">
    <input type="text " name="Beschreibung" id="" placeholder="Beschreibung">
    <input type="text " name="Autor" id="" placeholder="Autor">
    <input type="date " name="Veroeffentlichungsdatum" id="" placeholder="Veroeffentlichungsdatum">
    <input type="number" name="Preis" id="" placeholder="Preis">
    <button type="submit">Neues Buch anlegen</button>
</form>

<?php
// Asumiendo que $conn es una conexión válida
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura y validación de datos del formulario
    $Titel = isset($_POST['Titel']) ? $conn->real_escape_string($_POST['Titel']) : '';
    $Beschreibung = isset($_POST['Beschreibung']) ? $conn->real_escape_string($_POST['Beschreibung']) : '';
    $Autor = isset($_POST['Autor']) ? $conn->real_escape_string($_POST['Autor']) : '';
    $Veroeffentlichungsdatum = isset($_POST['Veroeffentlichungsdatum']) ? $conn->real_escape_string($_POST['Veroeffentlichungsdatum']) : '';
    $Preis = isset($_POST['Preis']) ? $conn->real_escape_string($_POST['Preis']) : '';

    // Verificar que todos los campos tienen valores
    if ($Titel && $Beschreibung && $Autor && $Veroeffentlichungsdatum && $Preis) {
        // Construir la consulta SQL
        $insertQuery = "INSERT INTO buecher (Titel, Beschreibung, Autor, Veroeffentlichungsdatum, Preis)
                        VALUES ('$Titel', '$Beschreibung', '$Autor', '$Veroeffentlichungsdatum', '$Preis')";

        // Ejecutar la consulta
        if ($conn->query($insertQuery) === true) {
            echo '<h4>Buch "' . htmlspecialchars($Titel) . '" erfolgreich angelegt</h4>';
        } else {
            echo 'Error: ' . $conn->error;
        }
    } else {
        echo '<h4>Alle Felder müssen ausgefüllt werden.</h4>';
    }
}
?>


</body>
</html>