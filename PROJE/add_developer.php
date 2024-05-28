<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'config.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("INSERT INTO Developers (name, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $email);

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
    <title>Yeni Yazılımcı Ekle</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            padding: 80px;
            max-width: 500px;
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
            padding: 12px;
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
            background-color: #f9f9f9;
            border: 1px solid #ccc;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Yeni Yazılımcı Ekle</h2>
        <?php echo $message; ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="name">İsim:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <?php if(!empty($message)) { ?>
                <div class="error-message"><?php echo $message; ?></div>
            <?php } ?>
            <button type="submit" class="btn btn-primary">Ekle</button>
        </form>
        <div class="text-right mt-3">
            <a href="dashboard.php" class="btn btn-secondary">Anasayfaya Dön</a>
        </div>
    </div>
</body>
</html>
