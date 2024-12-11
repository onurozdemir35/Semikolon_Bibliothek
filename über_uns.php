<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="über_uns.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <title>Über uns</title>
</head>
<body>

<!-- HEADER -->
<?php include 'header.php'; ?>


<!-- HAUPT-CONTAINER -->
    <section>
        <div class="haupt_container">
            <img src="bilder_2/nostalgi.jpeg" alt="Alte Bücher">
        </div>
    </section>

    <div class="gelb" style="background-color:#FFCC5C;">
        <h1>Über uns</h1>
    </div>
    <br>
    <p style="text-align: center; padding: 20px 80px;">Seit der Gründung 1968 bringt die Buchhandlung Semikolon seinen Kunden mit viel
        Leidenschaft und Einsatz das klassische Buchhandelssortiment nahe. Bei der positiven
        Entwicklung der letzten Jahre steht die buchhändlerische Kompetenz stets im Fokus und wird
        weiterhin gewahrt und gestärkt. Gleichzeitig wissen unsere Kunden, dass die Buchhandlung
        Semikolon für weit mehr steht.</p>
<br>
    <!-- FIRST CONTAINER -->
    <div class="container">
        <div class="container1">
            <p style="font-weight: bold;">Wir wollen unsere Liebe zum Buch weitergeben</p>
            <p>Die Geschichte der Buchhandlung Semikolon ist
                geprägt durch kontinuierliches Wachstum des
                Sortimentes und der Ausweitung unseres Angebots
                und unserer Kompetenzen. Wir legen einen hohen
                Anspruch an jeden Tag um dies weiterhin umzusetzen
                und um unsere Kunden auf ständig neue Weise zu
                begeistern.</p>
        </div>
        <div class="container2">
            <img src="bilder_2/owner.jpeg" alt="owner">
        </div>
    </div>

    <!-- SECOND CONTAINER -->
    <div class="container">
        <div class="container2">
            <img src="bilder_2/haus.jpeg" alt="Haus" style="flex: 1; height: 450px;">
        </div>
        <div class="container1">
            <p style="font-weight: bold; padding-top: 30%;">Unsere Vision ist die Schaffung eines Multi-Channel-Einkaufserlebnisses</p>
            <p>Unsere Vision ist es, dem Kunden ein höchst
                professionelles und zugleich persönliches Multi-
                Channel-Einkaufserlebnis bei uns zu ermöglichen.
                Dafür arbeiten wir stetig an unserem Onlineshop
                und unserer Onlinepräsenz parallel zu unseren
                Ladengeschäften, um unsere Kunden über neue
                Kontaktpunkte zu erreichen, und mit
                Informationen, Lesestoff und vielem mehr 24/7 zu
                versorgen.</p>
        </div>
    </div>

    <!-- THIRD CONTAINER -->
    <div class="container">
        <div class="container1">
            <p style="font-weight: bold;">Für uns steht der Mensch im Vordergrund</p>
            <p>Sowohl durch den Kundenservice in unseren 6 Filialen als
                auch durch unseren Onlineshop, unsere Social Media
                Präsenz und unsere zahlreichen Veranstaltungen ist es
                unser Ansporn, das persönliche und menschliche
                Element im Einzelhandel zu stärken.</p>
        </div>
        <div class="container2">
            <img src="bilder_2/biblio.jpeg" alt="wallandbooks">
        </div>
    </div>
    <br>

    <!--  BEWERTUNGEN  -->

    <?php include 'team.php'; ?>

    <!-- FILIALEN -->
    <div style="text-align: center; padding-top: 60px;">
        <h2 style="font-weight: bold;">Besuchen Sie uns in einer unserer 6 Filialen rund um die Region Hannover</h2>
        <p>Lernen Sie uns persönlich kennen, indem Sie unsere Filialen rund um Hannover und
        Niedersachsen besuchen!</p>
    </div>

    <!-- FLEXBOX -->
    <div class="flex-container">

        <div class="flex-item">
            <h3>Hannover</h3>
            <p>Bahnhofstraße 14,
                30159 Hannover</p>
        </div>
        <div class="flex-item">
            <h3>Langenhangen</h3>
            <p>Marktplatzt 5,
                30853 Langenhagen</p>
        </div>
        <div class="flex-item">
            <h3>Lehrte</h3>
            <p>Zuckerpassage 19,
                31275 Lehrte</p>
        </div>
        <div class="flex-item">
            <h3>Sarstedt</h3>
            <p>Steinstraße 26, 31157 
                Sarstedt</p>
        </div>
        <div class="flex-item">
            <h3>Goslar</h3>
            <p>Breite Str. 98, 38640 Goslar</p>
        </div>
        <div class="flex-item">
            <h3>Hildesheim</h3>
            <p>Goethestraße 66, 31135
            Hildesheim</p>
        </div>
    </div>

    <!-- FOOTER -->
    <?php include 'footer.php'; ?>
    
</body>
</html>