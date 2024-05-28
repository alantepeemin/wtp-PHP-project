# wtp-PHP-project
Web Tabanlı Programlama dersi PHP ve MySQL ile web sayfası oluşturma projesi

## Yazılım Şirketi Yönetim Sistemi
Proje , bünyesinde yazılımcı barındıran bir şirketin aldığı işleri sisteme yüklemesi ,yönetmesi ve işleri yazılımcılara vermesi konularıyla ilgilenir.

## Başlarken
Projeyi yerel makinenizde çalıştırmak için aşağıdaki adımları izleyin.
## Gereksinimler
- XAMPP veya benzeri bir sunucu.
- Web tarayıcısı 

## Kurulum
### 1. XAMPP İndirme ve Kurma
XAMPP'ı [buradan](https://www.apachefriends.org/tr/index.html) indirip bilgisayarınıza kurun:

### 2. Veritabanını Oluşturma
1. XAMPP Kontrol Panelini açın.
2. MySQL servisini başlatın.
3. Tarayıcınızı açın ve http://localhost/phpmyadmin adresine gidin.
4. Yeni bir veritabanı oluşturun. Örneğin: `personel`.
5. `personel.sql` dosyasını phpMyAdmin üzerinden oluşturduğunuz veritabanında içe aktarın.

### 3. Dosyaları XAMPP'a Kopyalama
1. Tüm PHP dosyalarını ve diğer gerekli dosyaları indirin.
2. İndirdiğiniz dosyaları XAMPP'ın `htdocs` dizinine kopyalayın.

### 4. Veritabanına bağlanma
config.php dosyasını kendi veritabanınıza göre düzenleyin:
```php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "personel"; //  veritabanı adı 

// Bağlantı oluşturma
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı başarısız: " . $conn->connect_error);
}
```


