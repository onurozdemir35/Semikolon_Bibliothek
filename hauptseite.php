<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semikolon Header</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="hauptseite.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
</head>
<body>
    
    <?php include 'header.php'; ?>
  
    

   

    <!-- Swiper -->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="bilder_2/scroll_1.jpg" class="swiper-img" alt="Book Image 1"></div>
            <div class="swiper-slide"><img src="bilder_2/scroll_2.jpg" class="swiper-img" alt="Book Image 2"></div>
            <div class="swiper-slide"><img src="bilder_2/scroll_3.jpg" class="swiper-img" alt="Book Image 3"></div>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true, 
            },
        });
    </script>


    <!-- Bestseller Seite -->
<?php include 'index.php'; ?>


<!-- Gutschein Foto -->
<div class="gutschein-container">
    <div class="gutschein-image">
        <img src="bilder_2/geschenk.jpg" alt="gutschein">
    </div>
    <div class="gutschein-text">
        <h2>Geschenkgutschein</h2>
        <p>Genau das Richtige, um Freude zu verschenken: Die gesamte Auswahl aus Büchern, Hörbüchern und vielem mehr!</p>
        <button class="gutschein-button">Verschenken</button>
    </div>
</div>




<!-- Footer -->
<?php include 'footer.php'; ?>

</body>
</html>
