<?php

session_start();

// Připojení k databázi
include 'config.php';

$sql = "SELECT * FROM settings LIMIT 1";
$r = mysqli_query($conn, $sql);
$s = mysqli_fetch_array($r);

include '../theme.php';

$sql = "SELECT * FROM settings LIMIT 1";
$r_s = mysqli_query($conn, $sql);
$s = mysqli_fetch_array($r_s);

// Zpracování formuláře přihlášení
if (isset($_POST["submit"])) {
  $username = trim($_POST["username"]);
  $password = trim($_POST["password"]);

  // Získání uloženého hesla pro zadané uživatelské jméno
  $query = "SELECT id, name, password_md5 AS password, admin FROM users WHERE username = '$username'";
  $result = $conn->query($query);

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $hashed_password = $row["password"];

    // Ověření hesla
    if (md5($password) == $hashed_password) {
      $_SESSION["user_id"] = $row["id"];
      $_SESSION["user_name"] = $row["name"];

      if($row['admin'])
        $_SESSION['user_admin'] = 1;
      else
        $_SESSION['user_admin'] = 0;

        if(isset($_GET['url'])){
          header("Location: ../" . $_GET['url']); // Přesměrování na hlavní stránku po přihlášení
          
        }
        else{
          header("Location: ../"); // Přesměrování na hlavní stránku po přihlášení
        }

      exit();
     } 
    else {
      header("Location: ?passErr");
    }
  } 
  else {
      header("Location: ?userErr");
  }
}
?>
 
<?php include '../assets/header.php'?>

    <main>
      <div class="album py-5 bg-body-tertiary">
        <div class="container">
          <div class="row">
          <form method="post" class="mx-auto col-sm-4">
            <?php if(isset($_GET['signupnotallowed'])):?>
              <div class="alert alert-danger">
                <span>Registrace uživatele není na tomto webu povolena</span>
              </div>
              <?php endif;?>
              <div class="form-floating mb-3">
                <input type="text" class="form-control <?php echo isset($_GET['userErr']) ? 'is-invalid' : '';?>" id="floatingInput" placeholder="name@example.com" name="username">
                <label for="floatingInput">Uživateské jméno</label>
                <div class="invalid-feedback">
                  Uživatel nebyl nalezen.
                </div>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control <?php echo isset($_GET['passErr']) ? 'is-invalid' : '';?>" id="floatingPassword" placeholder="Password" name="password">
                <label for="floatingPassword">Heslo</label>
                <div class="invalid-feedback">
                  Heslo není správné.
                </div>
              </div>

              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
                <label class="form-check-label" for="rememberPasswordCheck">
                  Zapamatovat si mě
                </label>
              </div>
              <div class="d-grid">
                <button class="btn btn-success btn-login" type="submit" name="submit">Přihlásit</button>
              </div>
              <hr class="my-4">
              <div class="d-grid mb-2">
                <a class="btn btn-link text-decoration-none" href="signup.php">
                  Ještě nemáte účet? Zaregistrujte se
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>

  <?php include '../assets/footer.php'?>
