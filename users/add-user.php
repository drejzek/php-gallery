<?php
include "../config.php";

// Funkce pro generování unikátního uživatelského jména
function generateUniqueUsername($baseUsername, $conn) {
    $g_username = $baseUsername;
    $counter = 0;

    while (isUsernameTaken($g_username, $conn)) {
        $counter++;
        $g_username = $baseUsername . $counter;
    }

    return $g_username;
}

$g_username = generateUniqueUsername('uzivatel', $conn);

// Funkce pro kontrolu, zda uživatelské jméno již existuje
function isUsernameTaken($username, $conn) {
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($query);

    return ($result && $result->num_rows > 0);
}

// Funkce pro kontrolu, zda e-mail již existuje
function isEmailTaken($email, $conn) {
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($query);

    return ($result && $result->num_rows > 0);
}

// Funkce pro získání IP adresy
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

$errorMessage = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    

    // Získání IP adresy
    $ip_address = get_client_ip();

    // Kontrola, zda e-mail již není registrován
    if (empty($email)) {
        $errorMessage = "E-mail je povinný údaj.";
    } elseif (isEmailTaken($email, $conn)) {
        $errorMessage = "E-mail již existuje. Zvolte jiný e-mail.";
    } else {
        // Generování unikátního uživatelského jména
        $baseUsername = "uzivatel";
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password_rpt = $_POST['password_rpt'];

        if($password == $password_rpt){

            $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
            
            $verificationKey = md5(uniqid(rand(), true));

            // Přidání uživatele do tabulky "users" s výchozím množstvím kreditů a IP adresou
            $query = "INSERT INTO users (username, email, password, verified) VALUES ('$username', '$email', '$password', 0)";
            
            if ($conn->query($query) === TRUE) {
                // Odeslání ověřovacího e-mailu
                // if (sendVerificationEmail($email, $verificationKey)) {
                //     $successMessage = "Registrace byla úspěšná. Na váš e-mail byl odeslán ověřovací link pro ověření zda email vlastníte.";
                // } else {
                //     $errorMessage = "Chyba při odesílání ověřovacího e-mailu. Zkuste to prosím znovu.";
                // }
            } else {
                $errorMessage = "Chyba při registraci: " . $conn->error;
            }
        }
    }
}
?>

<?php include '../assets/header.php'?>
<style>
        .dot {
            height: 10px;
            width: 10px;
            border-radius: 50%;
            display: inline-block;
        }
    </style>
    <div class="container mt-4">
        <nav aria-label="breadcrumb mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item">Uživatelé</li>
                <li class="breadcrumb-item active" aria-current="page">Nový uživatel</li>
            </ol>
        </nav>
        <h2 class="">Nový uživatel</h2>
        <br>
        <div class="row">
            <div class="col-sm-7 mx-auto">
                <div class="container bg-white rounded shadow-sm p-4 px-5 pt-4 border">
                    <form method="post">
                        <?php
                            if (!empty($errorMessage)) {
                                echo '<script>window.onload = function() { alert("' . $errorMessage . '"); }</script>';
                                // Smazat chybovou zprávu po zobrazení
                                $errorMessage = "";
                            }

                            if (!empty($successMessage)) {
                                echo '<script>window.onload = function() { alert("' . $successMessage . '"); }</script>';
                                // Smazat úspěšnou zprávu po zobrazení
                                $successMessage = "";
                            };
                        ?>
                        <div class="row mb-3">
                            <label for="user" class="col-sm-2 col-form-label">Uživatel</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="user" name="username">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="pwd" class="col-sm-2 col-form-label">Heslo</label>
                            <div class="col-sm-10">
                            <input type="password" class="form-control" id="pwd" name="password">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="pwdrpt" class="col-sm-2 col-form-label">Heslo znovu</label>
                            <div class="col-sm-10">
                            <input type="password" class="form-control" id="pwdrpt" name="password_rpt">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Vytovřit</button>
                    </form>
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
                    url: "get-user-single-vm.php?id=<?php echo $id ?>", // URL to fetch updated user data
                    type: "GET",
                    success: function(data) {
                        $('#activity').html(data); // Update table body with fetched data
                    }
                });
            }

            // Initial call to update user table
            updateUserTable();

            // Schedule update every 5 seconds
            setInterval(updateUserTable, 1000);
        });
    </script>
</body>
</html>
