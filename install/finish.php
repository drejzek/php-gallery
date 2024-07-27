<?php
// Start the session
session_start();

// Check if the progress array exists in the session
if (isset($_SESSION['progress'])) {
    $progress = $_SESSION['progress'];
} else {
    echo "No progress data found.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Progress</title>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css">
    <style>
        .bg-success {
            color: white !important;
        }
        .bg-danger {
            color: white !important;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Progress Data</h1>
        <ul class="list-group">
            <li class="list-group-item">
                Database Test:
                <?php if ($progress['db_test']): ?>
                    <i class="fas fa-check-circle bg-success p-2 rounded-circle"></i>
                <?php else: ?>
                    <i class="fas fa-times-circle bg-danger p-2 rounded-circle"></i>
                <?php endif; ?>
            </li>
            <li class="list-group-item">
                Save Config:
                <?php if ($progress['db_save_config']): ?>
                    <i class="fas fa-check-circle bg-success p-2 rounded-circle"></i>
                <?php else: ?>
                    <i class="fas fa-times-circle bg-danger p-2 rounded-circle"></i>
                <?php endif; ?>
            </li>
            <li class="list-group-item">
                Make Tables:
                <?php if ($progress['db_make_tables']): ?>
                    <i class="fas fa-check-circle bg-success p-2 rounded-circle"></i>
                <?php else: ?>
                    <i class="fas fa-times-circle bg-danger p-2 rounded-circle"></i>
                <?php endif; ?>
            </li>
            <li class="list-group-item">
                Save User:
                <?php if ($progress['db_save_user']): ?>
                    <i class="fas fa-check-circle bg-success p-2 rounded-circle"></i>
                <?php else: ?>
                    <i class="fas fa-times-circle bg-danger p-2 rounded-circle"></i>
                <?php endif; ?>
            </li>
            <li class="list-group-item">
                Save Settings:
                <?php if ($progress['db_save_settings']): ?>
                    <i class="fas fa-check-circle bg-success p-2 rounded-circle"></i>
                <?php else: ?>
                    <i class="fas fa-times-circle bg-danger p-2 rounded-circle"></i>
                <?php endif; ?>
            </li>
        </ul>
    </div>
</body>
</html>
