<?php

    require_once 'config.php';

    // Kontrola připojení
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Dotaz na databázi
    $sql = "SELECT * FROM users WHERE id = " . $_GET['id'];
    $result = $conn->query($sql);
    
    // Výpis výsledků do tabulky
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<tr><td colspan='4'>No users found</td></tr>";
    }
    
    // Uzavření spojení s databází
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="bootstrap.css" rel="stylesheet">
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
        <a class="navbar-brand" href="#">Control Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="admin">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Aktivita virtuálních strojů</a>
            </li>
        </ul>
        <form class="d-flex" role="search">
            <div class="input-group">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search" id="searchInput">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </div>
        </form>
        </div>
    </div>
    </nav>
    <div class="container mt-4">
        <nav aria-label="breadcrumb mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item">Úprava uživatele</li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $row['username']?></li>
            </ol>
        </nav>
        <h2 class="">Úprava uživatele</h2>
        <span class="mall text-secondary mb-3">ID: <?php echo $row['id']?></span>
        <br>
        <br>
        <div class="container bg-white rounded shadow p-4 pt-4">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Přehled</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#act-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Aktivita</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Úpravy</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#pwd-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Změna helsa</button>
                </li>
                <li class="nav-item" role="presentation">
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                    <div class="d-flex pt-4">
                        <div class="container w-50 mx-auto">
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <b>Uživatelksé jméno</b>
                                </div>
                                <div class="col-sm-6">
                                    <?php

                                        echo $row['username'];
                                    
                                    ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <b>E-mail</b>
                                </div>
                                <div class="col-sm-6">
                                    <?php

                                        echo $row['email'];
                                    
                                    ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <b>Počáteční IP adresa</b>
                                </div>
                                <div class="col-sm-6">
                                    <?php

                                        echo $row['IP'];
                                    
                                    ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <b>Aktuální IP adresa</b>
                                </div>
                                <div class="col-sm-6">
                                    <?php

                                        echo !empty($row['last_ip']) ? $row['last_ip'] : "Žádná";
                                    
                                    ?>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <b>Stav účtu</b>
                                </div>
                                <div class="col-sm-6">
                                    <?php
                                        $status = $row['banned'];
                                        $dot_color = !$status ? 'bg-success' : 'bg-danger';
                                        $dot_text = !$status ? 'Aktivní' : 'Zablokovaný';
                                        echo "
                                            <span class='dot ".$dot_color."'></span>
                                            <span class=\"small text-secondary ms-2\">" . $dot_text . "</sapn>
                                        ";
                                    ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <b>Ověření</b>
                                </div>
                                <div class="col-sm-6">
                                    <?php
                                        $status = $row['verified'];
                                        $dot_color = $status ? 'bg-success' : 'bg-danger';
                                        $dot_text = $status ? 'Ověřený' : 'Neověřený';
                                        echo "
                                            <span class='dot ".$dot_color."'></span>
                                            <span class=\"small text-secondary ms-2\">" . $dot_text . "</sapn>
                                        ";
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                    <div class="d-flex pt-4 border-bottom pb-3">
                        <form class="w-50 mx-auto">
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Uživatelské jméno</label>
                                <div class="col-sm-9">
                                <input type="email" class="form-control" id="inputEmail3" value="<?php echo $row['username'] ?>">
                                </div>
                            </div>
                            <div class="row mb-5">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                <input type="email" class="form-control" id="inputPassword3" value="<?php echo $row['email'] ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-10 offset-sm-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="verified" <?php echo $row['verified'] ? "checked" : "" ?>>
                                        <label class="form-check-label" for="verified">Ověřený</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-10 offset-sm-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input bg-danger" type="checkbox" role="switch" id="banned" <?php echo $row['banned'] ? "checked" : "" ?>>
                                        <label class="form-check-label" for="banned">Zablokovaný</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Sign in</button>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="act-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                    <div class="d-flex pt-4">
                        <div class="container w-50 mx-auto">
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <b>Poslední aktivia</b>
                                </div>
                                <div class="col-sm-6">
                                    <?php

                                        echo $row['last_activity'];
                                    
                                    ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <b>Poslední aktivia VM1</b>
                                </div>
                                <div class="col-sm-6">
                                    <?php

                                        echo $row['VM1'];
                                    
                                    ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <b>Poslední aktivia VM2</b>
                                </div>
                                <div class="col-sm-6">
                                    <?php

                                        echo $row['VM2'];
                                    
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pwd-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">
                <div class="d-flex pt-4 border-bottom pb-3">
                        <form class="w-50 mx-auto">
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Heslo:</label>
                                <div class="col-sm-9">
                                <input type="password" class="form-control" id="inputEmail3">
                                </div>
                            </div>
                            <div class="row mb-5">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Heslo znovu:</label>
                                <div class="col-sm-9">
                                <input type="password" class="form-control" id="inputPassword3">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Uožit" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
