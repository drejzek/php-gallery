<?php
session_start();

// Připojení k databázi
include 'config.php';

$sql = "SELECT * FROM settings";
$r_s = mysqli_query($conn, $sql);
$s = mysqli_fetch_array($r_s);

$errpwdnotsame = 0;
// Zpracování formuláře přihlášení
if (isset($_POST["submit"])) {
  $name = $_POST["username"];
  $username = $_POST["username"];
  $email = $_POST["username"];
  $password = md5(trim($_POST["password"]));
  $password_rpt = md5(trim($_POST["passwordr"]));

  if($password == $password_rpt){
    // Získání uloženého hesla pro zadané uživatelské jméno
    echo $query = "INSERT INTO `users`
    (
      `aid`,
      `name`,
      `username`,
      `email`,
      `verified`,
      `banned`,
      `admin`,
      `folder_name`,
      `password`,
      `password_md5`
    ) 
    VALUES
    (
      '0',
      '$name',
      '$username',
      '$email',
      '" . $s['user_default_verify'] . "',
      '" . $s['user_default_banned'] . "',
      '0',
      '0',
      NULL,
      '$password'
    )";
    $result = $conn->query($query);
  }
  else{
    $errpwdnotsame = 1;
  }
}
?>
 
<?php include '../assets/header.php'?>

    <main>
      <div class="album py-5 bg-body-tertiary">
        <div class="container">
          <div class="row">
          <form method="post" class="mx-auto col-sm-4" action="">
            <h4>Registrace uživatele</h4>
            <?php if($errpwdnotsame):?>
            <div class="alert alert-danger">
              <span><strong>Chyba: </strong>hesla se neshodují.</span>
            </div>
            <?php endif;?>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="name">
                <label for="floatingInput">Jméno</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="username">
                <label for="floatingInput">Uživateské jméno</label>
              </div>
              <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingPassword" placeholder="Password" name="emaill">
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
              <hr class="my-4">
              <div class="d-grid mb-2">
                <a class="btn btn-link text-decoration-none" href=".">
                  Již máte účet? Přihlašte se
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>

  <?php include '../assets/footer.php'?>
