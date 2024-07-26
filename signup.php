<?php
session_start();

// Připojení k databázi
include 'config.php';
// Zpracování formuláře přihlášení
if (isset($_POST["submit"])) {
  $username = trim($_POST["username"]);
  $password = trim($_POST["password"]);

  // Získání uloženého hesla pro zadané uživatelské jméno
  $query = "SELECT id, password FROM users WHERE username = '$username'";
  $result = $conn->query($query);

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $hashed_password = $row["password"];

    // Ověření hesla
    //if (password_verify($password, $hashed_password)) {
      $_SESSION["user_id"] = $row["id"];
      header("Location: ."); // Přesměrování na hlavní stránku po přihlášení
      exit();
    // } 
    // else {
    //   header("Location: ?passErr");
    // }
  } 
  else {
      header("Location: ?userErr");
  }
}
?>
 
<?php include 'assets/header.php'?>

    <main>
      <div class="album py-5 bg-body-tertiary">
        <div class="container">
          <div class="d flex">
          <form method="post" action="login.php">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="name">
                <label for="floatingInput">Jméno</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="username">
                <label for="floatingInput">Uživateské jméno</label>
              </div>
              <div class="form-floating mb-3">
                <input type="emaill" class="form-control" id="floatingPassword" placeholder="Password" name="emaill">
                <label for="floatingPassword">E-mail</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                <label for="floatingPassword">Heslo</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="passwordr">
                <label for="floatingPassword">Heslo znovu</label>
              </div>
              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit" name="submit">zaregistrovat</button>
              </div>
              <div id="emailHelp" class="form-text">Kliknutím na tlačítko zaregistrovat soouhlasíte s <a href="../terms-of-use.php">podmínkami použití</a></div>
              <hr class="my-4">
              <div class="d-grid mb-2">
                <a class="btn btn-link" href=".">
                  <i class="fab fa-google me-2"></i> Již máte účet? Přihlašte se
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>

  <?php include 'assets/footer.php'?>
