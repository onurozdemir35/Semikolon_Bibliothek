<?php
// Datenbankverbindung und gemeinsame Teile einbinden
include 'includes/Verbindung.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admins Dashboard</title>
    <link rel="stylesheet" href="assets/css/stylesDashboard.css">
</head>
<body>
    <div class="container">
        <h1>Admins Dashboard</h1>

        <!-- Schaltfläche zum Hinzufügen eines neuen Buches -->
        <button class="add-book-btn" onclick="showAddForm()">Ein neues Buch einfügen</button>

        <!-- Modal zum Hinzufügen eines neuen Buches -->
        <div id="addBookModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="hideAddForm()">&times;</span>
                <h2>Ein neues Buch einfügen</h2>
                <form method="POST" action="actions/einfugen.php">
                    <label>Titel:</label>
                    <input type="text" name="new_title" required>

                    <label>Beschreibung:</label>
                    <textarea name="new_description" required></textarea>

                    <label>Autor:</label>
                    <input type="text" name="new_author" required>

                    <label>Veröffentlichungsdatum:</label>
                    <input type="date" name="new_date" required>

                    <label>Preis (€):</label>
                    <input type="number" name="new_price" step="0.01" required>

                    <button type="submit" class="save-btn">Speichern</button>
                    <button type="button" class="cancel-btn" onclick="hideAddForm()">Abbrechen</button>
                </form>
            </div>
        </div>

        <?php
        // Bucher aus der Datenbank abrufen
        $query = 'SELECT BuchID, Titel, Beschreibung, Autor, Veroeffentlichungsdatum, Preis FROM buecher';
        $result = $conn->query($query);

        if ($result->num_rows > 0): ?>
            <table class="books-table">
                <thead>
                    <tr>
                        <th>#</th> <!-- Enumerationsspalte -->
                        <th>BuchID</th>
                        <th>Titel</th>
                        <th>Beschreibung</th>
                        <th>Autor</th>
                        <th>Veroeffentlichungsdatum</th>
                        <th>Preis (€)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 1; ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr id="row-<?php echo $row['BuchID']; ?>">
                            <td><?php echo $counter++; ?></td> <!-- Enumeration -->
                            <td><?php echo htmlspecialchars($row['BuchID']); ?></td>
                            <td><?php echo htmlspecialchars($row['Titel']); ?></td>
                            <td><?php echo htmlspecialchars($row['Beschreibung']); ?></td>
                            <td><?php echo htmlspecialchars($row['Autor']); ?></td>
                            <td><?php echo htmlspecialchars($row['Veroeffentlichungsdatum']); ?></td>
                            <td><?php echo htmlspecialchars($row['Preis']); ?></td>
                            <td>
                                <button class="edit-btn" onclick="showEditForm(<?php echo $row['BuchID']; ?>)">Bearbeiten</button>
                                <button class="delete-btn" onclick="deleteBook(<?php echo $row['BuchID']; ?>)">Löschen</button>
                            </td>
                        </tr>
                        
                        <!-- Bearbeitungsformularzeile (standardmäßig ausgeblendet) -->
                        <tr id="edit-row-<?php echo $row['BuchID']; ?>" class="edit-row" style="display: none;">
                            <td colspan="8"> <!-- Spaltenanzahl anpassen, um die neue Spalte einzuschließen -->
                                <form id="edit-form-<?php echo $row['BuchID']; ?>" method="POST" action="actions/bearbeiten.php">
                                    <input type="hidden" name="edit_id" value="<?php echo $row['BuchID']; ?>">

                                    <label>Titel:</label>
                                    <input type="text" name="edit_title" value="<?php echo htmlspecialchars($row['Titel']); ?>" required>

                                    <label>Beschreibung:</label>
                                    <textarea name="edit_description" required><?php echo htmlspecialchars($row['Beschreibung']); ?></textarea>

                                    <label>Autor:</label>
                                    <input type="text" name="edit_author" value="<?php echo htmlspecialchars($row['Autor']); ?>" required>

                                    <label>Veröffentlichungsdatum:</label>
                                    <input type="date" name="edit_date" value="<?php echo $row['Veroeffentlichungsdatum']; ?>" required>

                                    <label>Preis (€):</label>
                                    <input type="number" name="edit_price" value="<?php echo htmlspecialchars($row['Preis']); ?>" step="0.01" required>

                                    <button type="submit" class="save-btn">Speichern</button>
                                    <button type="button" class="cancel-btn" onclick="hideEditForm(<?php echo $row['BuchID']; ?>)">Abbrechen</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Das Buch ist nicht gefunden.</p>
        <?php endif; ?>

        <!-- Button um nach oben zu gehen -->
        <button onclick="topFunction()" id="scrollTopBtn" title="Go to top">Zur Start</button>
    </div>
    <script src="assets/js/main_Dashboard.js"></script>
    <script src="assets/js/main_Dashboard.js"></script>
</body>
</html>

<?php
$conn->close();
?>
