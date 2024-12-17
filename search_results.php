<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
<?php
include"header.php";
?>
    <style>
       /* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #fff;
    margin: 0;
    padding: 0;
    color: #333;
}

h2 {
    text-align: center;
    margin-top: 30px;
    font-size: 1.5rem;
    color: #387478;
}

p {
    font-size: 1rem;
    color: #555;
}

/* Search Results Container */
.results-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    padding: 20px;
    
}

.book-item {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    padding: 15px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    transition: transform 0.3s ease;
}

.book-item:hover {
    transform: translateY(-5px);
}

.book-item img {
    max-width: 150px;
    height: auto;
    margin-bottom: 10px;
}

.book-item h3 {
    font-size: 1.25rem;
    color: #333;
    margin: 10px 0;
}

.book-item p {
    margin: 5px 0;
}

.book-item a {
    display: inline-block;
    margin-top: 10px;
    padding: 8px 15px;
    background-color: #FFCC5C;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.book-item a:hover {
    background-color: #387478;
}

/* Error Message */
p.no-results {
    text-align: center;
    color: #d9534f;
    font-size: 1.2rem;
}

/* Responsive Styles */
@media (max-width: 768px) {
    h2 {
        font-size: 1.5rem;
    }
}


    </style>
</head>
<body>
<?php

// Verbindung zur Datenbank herstellen
$servername = "localhost"; // Name des Servers
$username = "root"; // Benutzername für die Datenbank
$password = ""; // Passwort für die Datenbank
$dbname = "bibliothek"; // Name der Datenbank

// Verbindung initialisieren
$conn = new mysqli($servername, $username, $password, $dbname);

// Prüfen, ob die Verbindung erfolgreich ist
if ($conn->connect_error) {
    // Log the error and display a user-friendly message
    error_log("Connection failed: " . $conn->connect_error);
    die("Verbindung zur Datenbank konnte nicht hergestellt werden.");
}

// Check if the search query is set
if (isset($_GET['query'])) {
    $searchQuery = $_GET['query'];

    // Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM buecher WHERE Titel LIKE ? OR Autor LIKE ?");
    $searchTerm = "%$searchQuery%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm); // Bind the parameters to the query

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any results were found
    if ($result->num_rows > 0) {
        echo "<h2>Search Results for: '$searchQuery'</h2>";
        while ($row = $result->fetch_assoc()) {
            echo "<div class='book-item'>";
            
            // Display book image (if available)
            if (!empty($row['Bild'])) {
                echo "<img src='bilder/" . htmlspecialchars($row['Bild']) . "' alt='Book Image' style='max-width: 150px; margin-bottom: 10px;'>";
            }
          
            
            echo "<h3>" . htmlspecialchars($row['Titel']) . "</h3>";
            echo "<p>Author: " . htmlspecialchars($row['Autor']) . "</p>";
            echo "<p>Price: " . htmlspecialchars($row['Preis']) . "€</p>";
            echo "<p>Published on: " . htmlspecialchars($row['Veroeffentlichungsdatum']) . "</p>";
            
            echo "</div>";
        }
    } else {
        echo "<p>No results found for '$searchQuery'.</p>";
    }
} else {
    echo "<p>Please enter a search query.</p>";
}

// Close the database connection
$conn->close();
?>


</body>
</html>
