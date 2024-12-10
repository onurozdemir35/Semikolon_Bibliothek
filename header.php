<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semikolon Header</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
</head>
<body>
    <header>
        <div class="header-container">
            <!-- Logo -->
            <div class="logo">
                <img src="c:\Users\hshakademie5\Downloads\logo_ (2).png" alt="Semikolon Logo"> 
            </div>

            <!-- Menu -->
            <nav class="menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="bücher.php">Bücher</a></li>
                    <li><a href="kontakt.html">Kontakte</a></li>
                    <li><a href="uber_uns.html">Über uns</a></li>
                </ul>
            </nav>

            <!-- header Icons -->
                 
<div class="icons">
    <a href="fav.php" class="icon">
        <img src="c:\Users\hshakademie5\Downloads\favorite_24dp_387478_FILL0_wght400_GRAD0_opsz24.png" alt="Favorite" class="icon-img">
    </a>
    <a href="cart.php" class="icon">
        <img src="c:\Users\hshakademie5\Downloads\shopping_cart_24dp_387478_FILL0_wght400_GRAD0_opsz24.png" alt="Cart" class="icon-img">
    </a>
  
    <div class="dropdown">
      <a href="#" class="icon">
          <img src="c:\Users\hshakademie5\Downloads\person_24dp_387478_FILL0_wght400_GRAD0_opsz24.png" alt="Sign In" class="icon-img">
      </a>
  
      <!-- Dropdown Menu -->
      <div class="dropdown-menu">
          <a href="profile.php" class="dropdown-item">Profile</a>
          <a href="registrierung.php" class="dropdown-item">Login / Anmelden</a>
      </div>
  </div>
  <script>
    // Get the profile icon and the dropdown menu
  const profileIcon = document.querySelector('.dropdown');
  const dropdownMenu = document.querySelector('.dropdown-menu');
  
  
  profileIcon.addEventListener('click', function(event) {
      event.stopPropagation(); 
      dropdownMenu.classList.toggle('show-dropdown');
  });
  
  
  window.addEventListener('click', function(e) {
      if (!profileIcon.contains(e.target)) {
          dropdownMenu.classList.remove('show-dropdown');
      }
  });
  
  </script>
  
    </header>

    <!-- Search Bar -->
    <div class="search-container">
        <form action="search_results.php" method="get">
            <div class="search-wrapper">
                <input type="text" name="query" placeholder="Buch Suchen..." class="search-bar">
                <button type="submit" class="search-button">
                    <img src="c:\Users\hshakademie5\Downloads\search_24dp_387478_FILL0_wght400_GRAD0_opsz24 (1).png" alt="Search" class="search-icon">
                </button>
            </div>
        </form>
    </div>

    <!-- Swiper -->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="c:\Users\hshakademie5\Downloads\bild_1.jpg" class="swiper-img" alt="Book Image 1"></div>
            <div class="swiper-slide"><img src="c:\Users\hshakademie5\Downloads\bild_2.jpg" class="swiper-img" alt="Book Image 2"></div>
            <div class="swiper-slide"><img src="c:\Users\hshakademie5\Downloads\bild_3.jpg" class="swiper-img" alt="Book Image 3"></div>
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
</body>
</html>
