<?php

    include '../config.php';

    if(!empty($conn)){
        header('location: dashboard.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap-grid.css" rel="stylesheet" id="bootstrap-grid-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
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

    <form role="form" method="post" id="InstallWizzard">
        <div class="form-group">
            <label class="control-label">Adresa serveru:</label>
            <input maxlength="200" type="text" required="required" class="form-control" name="databaseHost" value="localhost">
        </div>
        <div class="form-group">
            <label class="control-label">Uživatelské jméno:</label>
            <input maxlength="200" type="text" required="required" class="form-control" name="databaseUser" value="root">
        </div>
        <div class="form-group">
            <label class="control-label">Heslo:</label>
            <input maxlength="200" type="text" required="required" class="form-control" name="databasePassword" value="root">
        </div>
        <div class="form-group">
            <label class="control-label">Název databáze:</label>
            <input maxlength="200" type="text" required="required" class="form-control" name="databaseName" value="gallery">
        </div>
        <button class="btn btn-primary nextBtn pull-right" type="submit">Odeslat</button>
    </form>
    
    <script src="script.js"></script>
</body>
</html>
