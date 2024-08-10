<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="process/config_file.php" method="post">
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
            <input maxlength="200" type="text" required="required" class="form-control" name="databaseName" value="gallery-test">
        </div>
        <button class="btn btn-primary nextBtn pull-right" type="submit">Další</button>
    </form>
</body>
</html>