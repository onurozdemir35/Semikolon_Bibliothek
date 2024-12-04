<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sem; Kolon</title>
    <link rel="stylesheet" href="footer.css"> <!-- CSS-Datei wird eingebunden -->
</head>
<body>
    <footer class="footer">
        <div class="footer-container">
            <!-- Kontaktbereich -->
            <div class="footer-section">
                <h4>Kontakt</h4>
                <ul>
                    <li><a href="#phone">Telefon: 123-456-7890</a></li>
                    <li><a href="mailto:info@semkolon.com">E-Mail: info@semkolon.com</a></li>
                    <li><a href="#hours">Arbeitszeiten: 09:00 - 18:00</a></li>
                </ul>
            </div>
            <!-- Über Sem; Kolon -->
            <div class="footer-section">
                <h4>Über Sem; Kolon</h4>
                <ul>
                    <li><a href="#about-us">Über uns</a></li>
                    <li><a href="#contact">Kontakt</a></li>
                    <li><a href="#faq">FAQ</a></li>
                </ul>
            </div>
            <!-- Hilfe -->
            <div class="footer-section">
                <h4>Hilfe</h4>
                <ul>
                    <li><a href="#shipping">Versand & Lieferung</a></li>
                    <li><a href="#returns">Rückgaberecht</a></li>
                    <li><a href="#payment">Zahlungsmethoden</a></li>
                </ul>
            </div>
        </div>
        <p>&copy; 2024 Sem; Kolon. Alle Rechte vorbehalten.</p>
    </footer>

    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-JQCOLFNR9Y"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'G-JQCOLFNR9Y'); // Hier wird Ihre Google Analytics-Tracking-ID eingefügt
    </script>

    <!-- Automatisches Link-Tracking mit JavaScript -->
    <script>
        // Alle Links (<a>-Tags) auf der Seite auswählen
        document.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function() {
                gtag('event', 'click', {
                    'event_category': 'Alle Links', // Kategorie: Alle Links
                    'event_label': link.href        // Der angeklickte Link (URL)
                });
            });
        });
    </script>
    <!-- Ende des Google Analytics- und JavaScript-Codes -->
</body>
</html>
