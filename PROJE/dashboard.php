<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'config.php';

$projects = $conn->query("SELECT Projects.id, Projects.name, Projects.description, Projects.priority, Developers.name as developer_name 
                          FROM Projects 
                          LEFT JOIN Developers ON Projects.developer_id = Developers.id");
$developers = $conn->query("SELECT * FROM Developers");

function getPriorityClass($priority) {
    switch ($priority) {
        case 'Basit':
            return 'border-left-success';
        case 'Orta':
            return 'border-left-warning';
        case 'Zor':
            return 'border-left-danger';
        default:
            return '';
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            padding: 30px;
        }
        .card {
            border: none;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
            padding: 20px;
            margin-bottom: 20px;
        }
        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }
        .card-title {
            font-size: 1.25rem;
            color: #333;
            margin-bottom: 15px;
        }
        .card-text {
            color: #666;
            margin-bottom: 20px;
        }
        .btn {
            border-radius: 20px;
            padding: 8px 20px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #218838;
        }
        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
        .btn-info:hover {
            background-color: #138496;
            border-color: #138496;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #c82333;
        }
        .logout-btn {
            position: fixed;
            top: 20px;
            right: 20px;
        }
        .border-left-success {
            border-left: 5px solid #28a745 !important;
        }
        .border-left-warning {
            border-left: 5px solid #ffc107 !important;
        }
        .border-left-danger {
            border-left: 5px solid #dc3545 !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="logout.php" class="btn btn-danger logout-btn">Çıkış Yap</a>
        <h2 class="mt-5">Mevcut Projeler</h2>
        <div class="text-right mb-3">
            <a href="add_project.php" class="btn btn-success">Yeni Proje Ekle</a>
        </div>
        <div class="row">
            <?php while($project = $projects->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card <?php echo getPriorityClass($project['priority']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $project['name']; ?></h5>
                            <p class="card-text"><?php echo $project['description']; ?></p>
                            <p class="card-text"><small class="text-muted">Yazılımcı: <?php echo $project['developer_name']; ?></small></p>
                            <p class="card-text"><small class="text-muted">Önem Seviyesi: <?php echo $project['priority']; ?></small></p>
                            <a href="update_project.php?id=<?php echo $project['id']; ?>" class="btn btn-info">Güncelle</a>
                            <a href="delete_project.php?id=<?php echo $project['id']; ?>" class="btn btn-danger">Sil</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <h2 class="mt-5">Yazılımcılar</h2>
        <div class="text-right mb-3">
            <a href="add_developer.php" class="btn btn-success">Yeni Yazılımcı Ekle</a>
        </div>
        <div class="row">
            <?php while($developer = $developers->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $developer['name']; ?></h5>
                            <p class="card-text"><?php echo $developer['email']; ?></p>
                            <a href="update_developer.php?id=<?php echo $developer['id']; ?>" class="btn btn-info">Güncelle</a>
                            <a href="delete_developer.php?id=<?php echo $developer['id']; ?>" class="btn btn-danger">Sil</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
