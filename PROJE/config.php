<?php
$servername = "localhost";
$username = "your_username"; // Veritabanı kullanıcı adı
$password = "your_password"; // Veritabanı şifresi
$dbname = "your_dbname";

// Veritabanı bağlantısını oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}
?>
