<?php

    session_start();
    if(isset($_SESSION['sakura_id'])){
        if($_SESSION['sakura_id'] == md5($_SESSION['username'])){

        }
        else{
            header('location: ./auth/');
            echo 'logged out';
        }
    }
    else{
        header('location: ./auth/');
        echo 'logged out';
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="datatables.css">
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
        <a class="navbar-brand" href="."><img width="24" src="https://img.icons8.com/external-vitaliy-gorbachev-lineal-color-vitaly-gorbachev/60/external-sakura-trees-vitaliy-gorbachev-lineal-color-vitaly-gorbachev.png" alt="external-sakura-trees-vitaliy-gorbachev-lineal-color-vitaly-gorbachev"/> Sakura Control Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href=".">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="vm-activity.php">Aktivita virtuálních strojů</a>
            </li>
        </ul>
        <form class="d-flex" role="search">
            <div class="input-group">
                <a class="btn btn-link text-black text-decoration-none" href="./auth/logout.php">Odhlásit se</a>
            </div>
        </form>
        </div>
    </div>
    </nav>
    <div class="container mt-5">
        <div class="d-flex">
            <h2 class="mb-4">Přehled uživatelů Max-Online.cz</h2>
            <div class="ms-auto">
                <a href="add-user.php" class="btn btn-outline-primary"><i class="fas fa-plus"></i> Přidat uživatele</a>
            </div>
        </div>
        
        <div class="table-responisve">
            <table  id="user-table" class="table table-hover bg-white">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Uživatel</th>
                        <th>Email</th>
                        <th>IP adresa</th>
                        <th>Stav účtu</th>
                        <th>Naposledy aktivní</th>
                        <th>Akce</th>
                    </tr>
                </thead>
                <tbody>
                
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="datatables.js"></script>
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
