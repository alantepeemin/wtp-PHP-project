<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'config.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE Developers SET name = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $name, $email, $id);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
    } else {
        $message = "Hata: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM Developers WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $developer = $result->fetch_assoc();

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yazılımcı Güncelle</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            padding: 30px;
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
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Yazılımcı Güncelle</h2>
        <?php echo $message; ?>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $developer['id']; ?>">
            <div class="form-group">
                <label for="name">İsim:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $developer['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $developer['email']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Güncelle</button>
        </form>
    </div>
</body>
</html>
