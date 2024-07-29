<?php

    require_once '../config.php';

    // Kontrola připojení
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    if (isset($_POST['submit'])) {
        $usernameOrEmail = $_POST["username"];
        $password = $_POST["password"];
    
        // Kontrola, zda je zadané uživatelské jméno nebo e-mail
        $field = filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL) ? "email" : "username";
    
        $query = "SELECT * FROM users WHERE $field = ? AND verified = 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $usernameOrEmail);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row["password"];
    
            // Kontrola hesla
            if (password_verify($password, $hashedPassword)) {
                // Kontrola zda je účet zabanovaný
                if ($row["banned"] == 1) {
                    $error = "Váš účet byl zabanován. Pro více informací kontaktujte podporu na support@max-online.cz .";
                } else {
                    if($row['superadmin']){
                        // Přihlášení úspěšné
                        session_start();
                        $_SESSION["username"] = $row["username"];
                        $_SESSION["superadmin"] = $row["superadmin"];
                        $_SESSION["id"] = $row["id"];
                        $_SESSION["sakura_id"] = md5($row['username']);
        
                        header("Location: ../"); // Přesměrování na úvodní stránku po přihlášení
                        exit();
                    }
                }
            } else {
                $error = "Nesprávné heslo.";
            }
        } else {
            // Kontrola, zda je účet ověřen
            $queryUnverified = "SELECT * FROM users WHERE $field = ? AND verified = 0";
            $stmtUnverified = $conn->prepare($queryUnverified);
            $stmtUnverified->bind_param("s", $usernameOrEmail);
            $stmtUnverified->execute();
            $resultUnverified = $stmtUnverified->get_result();
    
            if ($resultUnverified && $resultUnverified->num_rows > 0) {
                $error = "Účet není ověřen. Přejděte do emailové schránky a ověřte ho pomocí odkazu, který vám byl zaslán. ( pokdu jeste se již dříve registrovali a email z linkem pro ověření nemáte kontaktujte mě na support@max-online.cz )";
            } else {
                $error = "Neplatné uživatelské jméno nebo e-mail. ( tato zpráva se může zobrazovat opakovaně po načtení stránky pokud jste již dříve zadali špatné údaje pro přihlášení )";
            }
        }
    }


    if(isset($_POST['submit-ar'])){
        session_start();
        if(isset($_SESSION['username'])){
            if(isset($_SESSION['superadmin'])){
                if($_SESSION['superadmin']){
                    $_SESSION["sakura_id"] = md5($_SESSION['username']);
                    header('location: ../');
                }
            }
        }
    }


    session_start();
    $_SESSION["username"] = 'david.rejzek';
    $_SESSION["superadmin"] = 1;
    $_SESSION["id"] = 4;
    $_SESSION["sakura_id"] = md5('david.rejzek');

   // header("Location: ../"); // Přesměrování na úvodní stránku po přihlášení

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link href="../bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        .dot {
            height: 10px;
            width: 10px;
            border-radius: 50%;
            display: inline-block;
        }
    </style>
</head>
<body class="bg-body-tertiary pb-5">
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href=".">Control Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        </div>
    </div>
    </nav>
    <div class="container mt-4">
        <nav aria-label="breadcrumb mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item active">Přihlášení</li>
            </ol>
        </nav>
        <br>
        <div class="">
            <div class="">
                <form class="container bg-white rounded shadow-sm p-4 pt-4 pt-4 border-top border-bottom pb-3 w-50 mb-3" method="post">
                    <h3 class="border-bottom pb-3 mb-4">Přihlášení uživatele</h3>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Uživatelské jméno:</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputEmail3" name="username">
                        </div>
                    </div>
                    <div class="row mb-5">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Heslo:</label>
                        <div class="col-sm-9">
                        <input type="password" class="form-control" id="inputPassword3" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Přihlásit" class="btn btn-success" name="submit">
                    </div>
                </form>
                <form action="" class="container bg-white rounded shadow-sm p-4 pt-4 pt-4 border-top border-bottom pb-3 w-50" method="post">
                    <input type="submit" value="Přihlásit se na základě aktivní relace" class="btn btn-outline-success" name="submit-ar">
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script>
        // Inicializace DataTables
  </script>
    <script>
        $(document).ready(function(){
            // Function to update user table
            function updateUserTable() {
                $.ajax({
                    url: "get-users-mocz.php", // URL to fetch updated user data
                    type: "GET",
                    success: function(data) {
                        $('#user-table tbody').html(data); // Update table body with fetched data
                        $('#user-table').DataTable();
                    }
                });
            }

            // Initial call to update user table
            updateUserTable();

            // Schedule update every 5 seconds
            //setInterval(updateUserTable, 5000);
        });
    </script>
</body>
</html>
