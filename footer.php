<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<style>
    .footer li a:hover {
        color: black !important;
        transition: color 0.3s ease;
    }
    .legal-links a:hover {
        color: black !important;
        transition: color 0.3s ease;
    }

    /*Resposive tasarim*/

    
    /* Varsayılan desktop tasarımı (mevcut kodlar) */
    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
   }

    
    .top-section, .middle-section, .bottom-section {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }
    .middle-section div {
        flex: 1;
    }
    .social-media a {
        font-size: 24px;
    }
    .app-icons a {
        font-size: 14px;
    }

    /* Responsiv tasarım: 768px ve daha küçük ekranlar */
    @media (max-width: 768px) {
        
        .middle-section, .bottom-section {
            flex-direction: column; /* Dikey hizalama */
            align-items: center;
        }
        .middle-section div {
            margin-bottom: 20px;
            text-align: center; /* Ortala */
        }
        .trusted-shops iframe {
            width: 90%; /* Ekranın %90'ını kapla */
            height: 150px; /* Daha yüksek yap */
        }
        .social-media a {
            font-size: 20px; /* İkon boyutunu küçült */
        }
        .app-icons a {
            font-size: 12px; /* Daha küçük metin */
        }
    }

    /* Responsiv tasarım: 480px ve daha küçük ekranlar */
    @media (max-width: 480px) {
        .footer-container {
            padding: 0 10px; /* Kenar boşluklarını azalt */
        }
        .middle-section div {
            margin-bottom: 15px;
        }
        .trusted-shops iframe {
            width: 100%;
            height: 120px;
        }
        .social-media a {
            font-size: 18px;
            margin-right: 10px; /* Daha fazla boşluk */
        }
        .app-icons a {
            font-size: 12px;
        }
    }


</style>

<!-----------------------------------------------------------FOOTER.JS-------------------------------------------------->

<footer class="footer" style="width: 100%; font-family: Arial, sans-serif; color: grey; margin: 0; padding: 20px 0; background-color: #f8f9fa;">
    <div class="footer-container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;"> <!-- Sağ ve sol margin artırıldı -->
        <!-- Üst Kısım: Kargo ve Ödeme -->
        <div class="top-section" style="display: flex; justify-content: space-between; padding: 10px 0;">
            <div class="shipping" style="flex: 1; text-align: center;">
                <h4 style="font-size: 14px; margin-bottom: 5px;  color: black;">ZUGESTELLT DURCH</h4>
                <i class="fas fa-shipping-fast" style="font-size: 30px; margin: 0 5px; color: #0065A4;"></i>
                <i class="fab fa-dhl" style="font-size: 40px; margin: 0 5px; color: #FFCC00;"></i>
            </div>
            <div class="payment" style="flex: 1; text-align: center;">
                <h4 style="font-size: 14px; margin-bottom: 5px; color: black;">SICHER & BEQUEM BEZAHLEN</h4>
                <i class="fab fa-cc-visa" style="font-size: 30px; margin: 0 5px; color: #1A1F71;"></i>
                <i class="fab fa-cc-mastercard" style="font-size: 30px; margin: 0 5px; color: #EB001B;"></i>
                <i class="fab fa-paypal" style="font-size: 30px; margin: 0 5px; color: #003087;"></i>
                <i class="fas fa-money-check-alt" style="font-size: 30px; margin: 0 5px; color: #006400;"></i>
            </div>
            <div class="trusted-shops" style="flex: 1; text-align: center;">
                <h4 style="font-size: 14px; margin-bottom: 5px; color: black; width: 100%;">TRUSTED SHOPS</h4>
                    <iframe 
                         src="https://www.wikipedia.org"
                         frameborder="0" 
                         scrolling="yes" 
                         width="250" 
                         height="120" 
                         title="Mock Trusted Shops Widget"
                         style="border: none;">
                    </iframe>
            </div>
        </div>

        <!-- Orta Kısım: Kategoriler -->
        <div class="middle-section" style="display: flex; justify-content: space-between; padding: 5px 0;"> <!-- Padding azaltıldı -->
            <div class="contact" style="flex: 1; font-size: 16px; margin-right: 5px; margin-left: 10% "> <!-- Bölümler arasındaki boşluk azaltıldı -->
                <h4 style="font-size: 16px; margin-bottom: 5px; color: black; ">KONTAKT</h4>
                <p style="margin-bottom: 5px;">Servicehotline<br>089 - 30 75 79 00<br>Mo. - Sa. 9.00 - 18.00 Uhr</p>
                <p style="margin-bottom: 5px;">Filialhotline<br>089 - 30 75 75 75<br>Mo. - Sa. 9.00 - 18.00 Uhr</p>
            </div>
            <div class="company" style="flex: 1; font-size: 12px; margin-right: 10px;">
                <h4 style="font-size: 14px; color: black; margin-bottom: 5px;">Sem;kolon</h4>
                <ul style="list-style-type: none; padding: 0;">
                    <li style="margin-bottom: 7px;"><a href="index.php" style="text-decoration: none; color: grey;">Unternehmen</a></li>
                    <li style="margin-bottom: 7px;"><a href="kontakt.php" style="text-decoration: none; color: grey;">Kontakt</a></li>
                    <li style="margin-bottom: 7px;"><a href="https://www.hugendubel.com/karriere/" style="text-decoration: none; color: grey;">Karriere</a></li>
                    <li style="margin-bottom: 7px;"><a href="https://www.hugendubel.info/services/schulen" style="text-decoration: none; color: grey;">Service für Schulen</a></li>
                    </ul>
            </div>

            <div class="help" style="flex: 1; font-size: 12px; margin-right: 10px;">
                <h4 style="font-size: 14px; margin-bottom: 5px; color: black;">Hilfe</h4>
                <ul style="list-style-type: none; padding: 0;">
                    <li style="margin-bottom: 7px;"><a href="https://hugendubelgmbh.freshdesk.com/support/solutions/folders/103000546418" style="text-decoration: none; color: grey;">Zahlungsarten</a></li>
                    <li style="margin-bottom: 7px;"><a href="https://hugendubelgmbh.freshdesk.com/support/solutions/articles/103000187328-wie-hoch-sind-die-zu-erwartenden-versandkosten-" style="text-decoration: none; color: grey;">Lieferung & Versandkosten</a></li>
                    <li style="margin-bottom: 7px;"><a href="https://hugendubelgmbh.freshdesk.com/support/solutions/folders/103000546432" style="text-decoration: none; color: grey;">Retouren</a></li>
                    <li style="margin-bottom: 7px;"><a href="https://hugendubelgmbh.freshdesk.com/support/solutions/articles/103000187382-wie-lade-ich-ebooks-auf-meinen-tolino-ereader-" style="text-decoration: none; color: grey;">eBooks laden</a></li>
                </ul>
            </div>

            <div class="services" style="flex: 1; font-size: 12px;">
                <h4 style="font-size: 14px; margin-bottom: 5px; color: black;">Unsere Services</h4>
                <ul style="list-style-type: none; padding: 0;">
                    <li style="margin-bottom: 7px;"><a href="https://www.hugendubel.de/de/category/83868/hugendubel_kundenkarte.html" style="text-decoration: none; color: grey;">Kundenkarte</a></li>
                    <li style="margin-bottom: 7px;"><a href="https://www.hugendubel.de/de/category/91284/hugendubel_app.html" style="text-decoration: none; color: grey;">Sem;kolon App</a></li>
                    <li style="margin-bottom: 7px;"><a href="https://www.hugendubel.de/de/category/86988/leseglueck_buch_abo.html" style="text-decoration: none; color: grey;">Lesen-Abo</a></li>
                    <li style="margin-bottom: 7px;"><a href="https://www.hugendubel.de/de/category/128418/unidays.html" style="text-decoration: none; color: grey;">Studierendenrabat</a></li>
                </ul>
            </div>

        </div>


        <!-- Alt Kısım: Sosyal Medya ve App -->
        <div class="bottom-section" style="display: flex; justify-content: space-between; align-items: center; padding: 5px 0; margin-left: 10%"> <!-- Padding azaltıldı -->
            <div class="social-media" style="flex: 1;">
                <a href="https://www.facebook.com" target="_blank" style="text-decoration: none; color: #3b5998; margin-right: 5px;"><i class="fab fa-facebook" style="font-size: 24px;"></i></a>
                <a href="https://www.instagram.com" target="_blank" style="text-decoration: none; color: #e1306c; margin-right: 5px;"><i class="fab fa-instagram" style="font-size: 24px;"></i></a>
                <a href="https://www.youtube.com" target="_blank" style="text-decoration: none; color: #ff0000; margin-right: 5px;"><i class="fab fa-youtube" style="font-size: 24px;"></i></a>
                <a href="https://www.buechermenschen.de" target="_blank" style="text-decoration: none; color: #0065A4; "><i class="fas fa-quote-right" style="font-size: 24px;"></i></a>
            </div>
            <div class="app-icons" style="flex: 1; text-align: right; font-size: 12px; margin-right: 5%;">
                <h4 style="font-size: 10px; margin-bottom: 5px; color: grey;">Laden Sie unsere App herunter.</h4>
                <a href="https://apps.apple.com/de/app/hugendubel-b%C3%BCcher-buchtipps/id1491456570" style="text-decoration: none; color: inherit; margin-left: 5px;"><i class="fab fa-apple" style="color: #000000; font-size: 24px;"></i> App Store</a>
                <a href="https://play.google.com/store/apps/details?id=de.hugendubel.app&pli=1" style="text-decoration: none; color: inherit; margin-left: 5px;"><i class="fab fa-google-play" style="color: #3bccff; font-size: 24px;"></i> Google Play</a>
            </div>
        </div>

        <div class="legal-links" style="text-align: center; font-size: 12px; margin-top: 10px;">
            <a href="https://www.hugendubel.de/de/shortcut/datenschutz" style="text-decoration: none; color: inherit; margin: 0 5px;">Datenschutz</a> |
            <a href="https://www.hugendubel.de/de/shortcut/rueckgabe" style="text-decoration: none; color: inherit; margin: 0 5px;">Widerrufsbelehrung</a> |
            <a href="https://www.hugendubel.de/de/shortcut/agbs" style="text-decoration: none; color: inherit; margin: 0 5px;">AGB</a> |
            <a href="https://www.hugendubel.de/de/shortcut/impressum" style="text-decoration: none; color: inherit; margin: 0 5px;">Impressum</a>
        </div>
    </div>

   

</footer>

