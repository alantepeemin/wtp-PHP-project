<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE Developers SET name = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $name, $email, $id);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
    } else {
        echo "Hata: " . $stmt->error;
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
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Yazılımcı Güncelle</h2>
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
