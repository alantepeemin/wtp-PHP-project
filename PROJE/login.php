<?php
include 'config.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM Users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            session_start();
            $_SESSION['user_id'] = $id;
            header("Location: dashboard.php");
            exit();
        } else {
            $message = '<div class="alert alert-danger" role="alert">Yanlış kullanıcı adı veya şifre!</div>';
        }
    } else {
        $message = '<div class="alert alert-danger" role="alert">Yanlış kullanıcı adı veya şifre!</div>';
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f1f1f1;
            font-family: 'Roboto', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 400px;
        }
        .container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 20px;
            padding: 15px;
            font-size: 16px;
            background-color: #f9f9f9;
            border: 1px solid #eee;
        }
        .btn {
            border-radius: 20px;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            background-color: #007bff;
            border: none;
            width: 100%;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .form-text {
            text-align: center;
            margin-top: 20px;
            color: #666666;
        }
        .form-text a {
            color: #007bff;
            text-decoration: none;
        }
        .form-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Giriş Yap</h2>
        <?php echo $message; ?>
        <form method="post" action="">
            <div class="form-group">
                <input type="text" class="form-control" id="username" name="username" placeholder="Kullanıcı Adı" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Şifre" required>
            </div>
            <button type="submit" class="btn btn-primary">Giriş Yap</button>
            <div class="form-text">
                <a href="register.php">Hesabın yok mu? Kayıt Ol</a>
            </div>
        </form>
    </div>
</body>
</html>
