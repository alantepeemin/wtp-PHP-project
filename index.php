<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Sayfası</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
        }

        h2 {
            color: #333;
        }

        p {
            color: #666;
            margin-bottom: 20px;
        }

        .login-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 24px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            outline: none;
        }

        .login-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hoş Geldiniz!</h2>
        <p>Lütfen giriş yapmak için aşağıdaki butona tıklayın:</p>
        <form action="PROJE/login.php" method="GET">
            <input type="submit" class="login-btn" value="Giriş Yap">
        </form>
    </div>
</body>
</html>
