<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'config.php';

$message = '';

$developers = $conn->query("SELECT id, name FROM Developers");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $developer_id = $_POST['developer_id'];
    $priority = $_POST['priority'];

    $stmt = $conn->prepare("INSERT INTO Projects (name, description, developer_id, priority) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $name, $description, $developer_id, $priority);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
    } else {
        $message = "Hata: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
    <!DOCTYPE html>
    <html lang="tr">
    <head>
        <meta charset="UTF-8">
        <title>Yeni Proje Ekle</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            body {
                background-color: #f8f9fa;
                font-family: Arial, sans-serif;
            }
            .container {
                padding: 0px;
                max-width: 650px;
                margin: 0 auto;
            }
            .btn {
                border-radius: 20px;
                padding: 8px 20px;
                font-size: 14px;
                font-weight: bold;
                cursor: pointer;
                transition: all 0.3s ease-in-out;
            }
            .btn-primary {
                border-radius: 20px;
                padding: 12px 24px;
                font-size: 16px;
                font-weight: bold;
                background-color: #007bff;
                border: none;
                width: 100%;
                cursor: pointer;
            }
            .btn-primary:hover {
                background-color: #0056b3;
            }
            .form-group label {
                font-weight: bold;
            }
            .form-control {
                border-radius: 20px;
                padding: 15px;
                font-size: 16px;
                background-color: #ffffff;
                border: 1px solid #ccc;
            }
            .form-control:focus {
                border-color: #007bff;
                box-shadow: none;
            }
            .card {
                border: none;
                border-radius: 10px;
                background-color: #f8f9fa;
                padding: 25px;
            }
            .text-right {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="card mt-5">
                <h2 class="text-center mb-4">Yeni Proje Ekle</h2>
                <?php echo $message; ?>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="name">Proje Adı:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Açıklama:</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="developer_id">Yazılımcı Seç:</label>
                        <select class="form-control" id="developer_id" name="developer_id" required>
                            <?php while($developer = $developers->fetch_assoc()): ?>
                                <option value="<?php echo $developer['id']; ?>"><?php echo $developer['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="priority">Önem Seviyesi:</label>
                        <select class="form-control" id="priority" name="priority" required>
                            <option value="Basit">Basit</option>
                            <option value="Orta">Orta</option>
                            <option value="Zor">Zor</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Ekle</button>
                </form>
                <div class="text-right mt-3">
                    <a href="dashboard.php" class="btn btn-secondary">Anasayfaya Dön</a>
                </div>
            </div>
        </div>
    </body>
    </html>

