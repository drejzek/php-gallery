<?php
// Start the session
session_start();

// Check if the progress array exists in the session
if (isset($_GET['result'])) {
    $result = $_GET['result'];

    $results = explode(';', $result);

    $config_file = explode(':', $results[0])[1];
    $db_test = explode(':', $results[1])[1];
    $tables = explode(':', $results[2])[1];
    $user = explode(':', $results[3])[1];
    $settings = explode(':', $results[4])[1];

} else {
    echo "No progress data found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap-grid.css" rel="stylesheet" id="bootstrap-css-grid">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<!------ Include the above in your HEAD tag ---------->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">
      Open source PHP Gallery
      </a>
    </div>
  </div>
</nav>

<div class="container row">
    <div class="panel panel-primary setup-content col-sm-6 mx-auto p-0">
        <div class="panel-heading">
            <h3 class="panel-title">Výsledek instalace</h3>
        </div>
        <div class="panel-body">
            <ul class="list-group">
                <li class="list-group-item d-flex">
                    <span class="me-auto">
                        Připojení k databázi
                    </span>
                    <?php if ($db_test): ?>
                        <i class="fas fa-check-circle text-success"></i>
                    <?php else: ?>
                        <i class="fas fa-times-circle bg-danger p-2 rounded-circle"></i>
                    <?php endif; ?>
                </li>
                <li class="list-group-item d-flex">
                    <span class="me-auto">
                        Uložení konfigurace
                    </span>
                    <?php if ($config_file): ?>
                        <i class="fas fa-check-circle text-success"></i>
                    <?php else: ?>
                        <i class="fas fa-times-circle text-danger"></i>
                    <?php endif; ?>
                </li>
                <li class="list-group-item d-flex">
                    <span class="me-auto">
                        Vytvoření tabulek v databázi
                    </span>
                    <?php if ($tables): ?>
                        <i class="fas fa-check-circle text-success"></i>
                    <?php else: ?>
                        <i class="fas fa-times-circle text-danger"></i>
                    <?php endif; ?>
                </li>
                <li class="list-group-item d-flex">
                    <span class="me-auto">
                        Vytvoření uživatele
                    </span>
                    <?php if ($user): ?>
                        <i class="fas fa-check-circle text-success"></i>
                    <?php else: ?>
                        <i class="fas fa-times-circle text-danger"></i>
                    <?php endif; ?>
                </li>
                <li class="list-group-item d-flex">
                    <span class="me-auto">
                        Uložení nastavení
                    </span>
                    <?php if ($settings): ?>
                        <i class="fas fa-check-circle text-success"></i>
                    <?php else: ?>
                        <i class="fas fa-times-circle text-danger"></i>
                    <?php endif; ?>
                </li>
            </ul>
            <a href="../" class="btn btn-primary">Dokončit</a>
        </div>
    </div>
</div>
</body>
</html>
