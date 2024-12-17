<?php
// Veritabanı bağlantısını başlat
$conn = new mysqli("localhost", "root", "", "bibliothek");

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// Admin bilgileri
$vorname = "Admin"; // Adminin adı
$nachname = "User"; // Adminin soyadı
$email = "admin@gmail.com"; // Adminin e-posta adresi
$password = "1234"; // Adminin şifresi

// Şifreyi hashle (güvenlik için)
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// SQL sorgusu
$sql = "INSERT INTO admins (Vorname, Nachname, Email, Passwort) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $vorname, $nachname, $email, $hashed_password);

// Ekleme işlemini gerçekleştir
if ($stmt->execute()) {
    echo "Admin başarıyla eklendi!";
} else {
    echo "Admin eklenirken bir hata oluştu: " . $stmt->error;
}

// Kaynakları serbest bırak ve bağlantıyı kapat
$stmt->close();
$conn->close();
?>
