<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Kontaktformular </title>
<link href="libs/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="kontakt.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <style>
        #map {
            height: 400px; /* Höhe */
            width: 90%;   /* Breite */
        }
    </style>
</head>

<body>

<?php include 'header.php'; ?>

  <div class="contact">
    <h1>Kontaktformular</h1>
    <form action="send_mail.php" method="post">
      <input name="security" type="hidden" value="secure">
      <div class="row">
        <div class="form-group col-md-4">
          <label for="SelectGender">Anrede</label>
          <select name="gender" class="form-control" id="SelectGender">
            <option value="Herr">Herr</option>
            <option value="Frau">Frau</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label for="InputName">Name</label>
          <input name="name" type="text" class="form-control" id="InputName">
        </div>
        <div class="form-group col-md-6">
          <label for="InputEmail">E-Mail-Adresse <span class="req">Pflichtfeld</span></label>
          <input name="email" type="email" class="form-control" id="InputEmail" aria-describedby="emailHelp" required>
        </div>  
      </div>      
      <div class="form-group">
        <label for="TextareaMessage">Nachricht <span class="req">Pflichtfeld</span></label>
        <textarea name="message" class="form-control" id="TextareaMessage" rows="3" required></textarea>
      </div>
      <div class="form-check">
          <input type="checkbox" id="opt-in" name="optin" value="1" class="form-check-input" required>   
          <label for="opt-in">
            <strong>HINWEIS</strong> <span class="req">Pflichtfeld</span><br>Ich habe die Hinweise in der <a href="#">Datenschutzerklärung</a> verstanden und stimme diesen hiermit zu.
          </label>
        </div>
      <button type="submit" name="sendform" class="btn btn-dark">Absenden</button>
    </form>
  </div>
  <div class="separator"></div>
  <div class="contact__map">
    <h2>Unsere Standorte</h2>
  <div class="container">
    <div class="row">
        <!-- Text-Abschnitt -->
        <div class="col-md-4">
            <h2>Unsere Standorte</h2>
            <h3>Standort Hannover</h3>
            <p>Adresse: Bismarckstraße 2, 30173 Hannover</p>
            <p>E-Mail: <a href="mailto:Hannover@semikolon.de">Hannover@semikolon.de</a></p>
            <p>Telefon: +49 511 123456</p>
            
            <h3>Standort Lehrte</h3>
            <p>Adresse: Mühlengasse 1, 31275 Lehrte</p>
            <p>E-Mail: <a href="mailto:Lehrte@semikolon.de">Lehrte@semikolon.de</a></p>
            <p>Telefon: +49 511 123457</p>
            
            <h3>Standort Langenhagen</h3>
            <p>Adresse: Eickenhof 15, 30851 Langenhagen</p>
            <p>E-Mail: <a href="mailto:Langenhagen@semikolon.de">Langenhagen@semikolon.de</a></p>
            <p>Telefon: +49 511 123458</p>
        </div>
        
        <!-- Kartenabschnitt -->
        <div class="col-md-8">
            <div id="map"></div>
        </div>
    </div>

</div>
<script>
  // Karte initialisieren
  const map = L.map('map').setView([52.3759, 9.7320], 11); // Zentriert auf Hannover


  // Tile-Layer von OpenStreetMap hinzufügen
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '© OpenStreetMap contributors'
  }).addTo(map);

  // Liste der Standorte
  const locations = [
  { lat: 52.356093, lng: 9.767851, title: "Standort Hannover", address: "Bismarckstraße 2, 30173 Hannover", email: "Hannover@semikolon.de" },
  { lat: 52.371875, lng: 9.979254, title: "Standort Lehrte", address: "Mühlengasse 1, 31275 Lehrte", email: "Lehrte@semikolon.de" },
  { lat: 52.436680, lng: 9.731579, title: "Standort Langenhagen", address: "Eickenhof 15, 30851 Langenhagen", email: "Langenhagen@semikolon.de" }
];

  // Marker für jeden Standort hinzufügen
  locations.forEach((location) => {
      L.marker([location.lat, location.lng]).addTo(map)
      .bindPopup(`
          <h3>${location.title}</h3>
          <p>Adresse: ${location.address || "N/A"}</p>
          <p><a href="mailto:${location.email}">${location.email || "N/A"}</a></p>`);
  });
</script>

<?php include 'footer.php'; ?>
</body>
</html>