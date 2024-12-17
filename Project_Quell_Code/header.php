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
    <header class="header">
        <div class="header-container">
            <!-- Logo -->
            <div class="logo">
                <img src="bilder_2/logo_.png" alt=Semikolon Logo> 
            </div>

            <!-- Menu -->
            <nav class="menu">
                <ul>
                    <li><a href="hauptseite.php">Hauptseite</a></li>
                    <li><a href="bücher.php">Bücher</a></li>
                    <li><a href="kontakt.php">Kontakte</a></li>
                    <li><a href="über_uns.php">Über uns</a></li>
                </ul>
            </nav>

            <!-- header Icons -->
                 
<div class="icons">
    <a href="warenkorb.php" class="icon">
        <img src="bilder_2/shopping-cart.png" alt="Favorite" class="icon-img">
    </a>
    <a href="favorite.php" class="icon">
        <img src="bilder_2/favorites_icon.png" alt="Cart" class="icon-img">
    </a>
  
    <div class="dropdown">
      <a href="#" class="icon">
          <img src="bilder_2/profil_icon.png" alt="Sign In" class="icon-img">
      </a>
  
      <!-- Dropdown Menu -->
      <div class="dropdown-menu">
          <a href="profile.php" class="dropdown-item">Profile</a>
          <a href="anmelden.php" class="dropdown-item">Login / Anmelden</a>
          <a href="bestellung.php" class="dropdown-item">Mein Bestellung</a>
          <a href="log_out.php" class="dropdown-item">Log Out </a>
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
                    <img src="bilder_2/search_icon.png" alt="Search" class="search-icon">
                </button>
            </div>
        </form>
    </div>

    
</body>
</html>
