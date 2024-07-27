<?php $admin = true; ?>
<?php include '../sess.php'?>
<?php include 'config.php'?>
<?php
$id = "";
$alert_type = null;
$alert_ico = null;
$alert_message = null;
$alert_visible = 0;
// Kontrola připojení
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
// Dotaz na databázi
$sql = "SELECT * FROM users WHERE id = " . $_SESSION['user_id'] . "";
$result = $conn->query($sql);
// Výpis výsledků do tabulky
if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$id = $row['id'];
} else {
echo "<tr><td colspan='4'>No users found</td></tr>";
}
if(isset($_POST['submit-edits'])){
$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
// $password = $_POST['password'];
for($i=0;$i<2;$i++)
$sfield[$i] = isset($_POST['field'][$i]) ? 1 : 0;
$sql = "UPDATE `users` SET `name`='$name', `username`='$username', `email`='$email', `verified`='" . $sfield[0] . "', `banned`='" . $sfield[1] . "' WHERE id = $id";
$r = mysqli_query($conn, $sql);
}
/* $sql = "SELECT * FROM user_privileges WHERE user_id=$id";
$up = mysqli_fetch_array(mysqli_query($conn, $sql)); */
/* $up_login = $up['login'] ? 1 : 0;
$up_messages_send = $up['messages_send'] ? 1 : 0;
$up_messages_recieve = $up['messages_recieve'] ? 1 : 0;
$up_company_maintence = $up['company_maintence'] ? 1 : 0;
$up_reg_keys = $up['reg_keys'] ? 1 : 0;
$up_users = $up['users'] ? 1 : 0; */
/* if(isset($_POST['submitPrivileges'])){
$sql = "UPDATE user_privileges
SET
`login`='" . (isset($_POST['up_login']) ? $_POST['up_login'] : "") ."',
`messages_send`='" . (isset($_POST['up_messages-send']) ? $_POST['up_messages-send'] : "") ."',
`messages_recieve`='" . (isset($_POST['up_messages-recieve']) ? $_POST['up_messages-recieve'] : "") ."',
`company_maintence`='" . (isset($_POST['up_company-maintence']) ? $_POST['up_company-maintence'] : "") ."',
`reg_keys`='" . (isset($_POST['up_reg-keys']) ? $_POST['up_reg-keys'] : "") ."',
`users`='" . (isset($_POST['up_users']) ? $_POST['up_users'] : "") ."'
WHERE user_id=$id";
if(mysqli_query($conn, $sql)){
$alert_message = "Změny byly úspěšně uloženy.";
$alert_type = "success";
$alert_visible = 1;
}
else{
$alert_message = "Při ukládání nastala.";
$alert_type = "danger";
$alert_visible = 1;
}
} */
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
<li class="breadcrumb-item">Profil uživatele</li>
<li class="breadcrumb-item active" aria-current="page"><?php echo $row['username']?></li>
</ol>
</nav>
<h2 class="">Profil uživatele</h2>
<span class="mall text-secondary mb-3">ID: <?php echo $id?></span>
<br>
<div class="alert alert-<?php echo $alert_type?> alert-dismissible fade show" role="alert" style="<?php echo $alert_visible ? "display:block" : "display:none"?>">
<i class="bi bi-<?php echo $alert_ico ?> me-1"></i>
<?php echo $alert_message ?>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<br>
<div class="container rounded shadow-sm p-4 pt-4 mb-5 border">
<ul class="nav nav-tabs" id="myTab" role="tablist">
<li class="nav-item" role="presentation">
<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Přehled</button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Úpravy</button>
</li>
<!-- <li class="nav-item" role="presentation">
<button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#priv-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Oprávnění</button>
</li> -->
<li class="nav-item" role="presentation">
<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#pwd-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Změna hesla</button>
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
<b>Jméno</b>
</div>
<div class="col-sm-6">
<?php
echo $row['name'];
?>
</div>
</div>
<div class="row mb-3">
<div class="col-sm-6">
<b>Uživatelské jméno</b>
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
echo !empty($row['ip']) ? $row['ip'] : "Žádná";
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
<form class="w-50 mx-auto" method="post">
<div class="row mb-3">
<label for="name" class="col-sm-3 col-form-label">Uživatelské jméno</label>
<div class="col-sm-9">
<input type="text" name="name" class="form-control" id="name" value="<?php echo $row['name'] ?>">
</div>
</div>
<div class="row mb-3">
<label for="username" class="col-sm-3 col-form-label">Uživatelské jméno</label>
<div class="col-sm-9">
<input type="text" name="username" class="form-control" id="username" value="<?php echo $row['username'] ?>" disabled>
</div>
</div>
<div class="row mb-5">
<label for="email" class="col-sm-3 col-form-label">Email</label>
<div class="col-sm-9">
<input type="email" name="email" class="form-control" id="email" value="<?php echo $row['email'] ?>">
</div>
</div>
<button type="submit" class="btn btn-primary" name="submit-edits">Uložit</button>
</form>
</div>
</div>
<!-- <div class="tab-pane fade" id="priv-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
<div class="d-flex pt-4">
<div class="container w-50 mx-auto" id="activity">
<form action="" method="post">
<div class="form-group mb-3">
<label for="" class="form-label">Základní Oprávnění</label>
<select class="form-select" id="perm-select">
<option value="">- Vyberte -</option>
<option value="0">Žádné</option>
<option value="1">Standardní uživatel</option>
<option value="2">Administrátor</option>
</select>
</div>
<label for="" class="form-label mt-3">Vlastní nastavení</label>
<div class="table-responsive">
<table class="table table-striped border">
<thead class="fw-bold">
<tr>
<td>
Akce
</td>
<td class="text-success">
Povoleno
</td>
<td class="text-danger">
Zakázáno
</td>
</tr>
</thead>
<tbody>
<tr>
<fieldset>
<td>
Přihlášení
</td>
<td>
<div class="form-check">
<input class="form-check-input" type="radio" name="up_login" id="login1" value="1" <?php echo $up_login ? "checked" : "" ?>>
</div>
</td>
<td>
<div class="form-check">
<input class="form-check-input" type="radio" name="up_login" id="login0" value="0" <?php echo $up_login ? "" : "checked" ?>>
</div>
</td>
</fieldset>
</tr>
<tr>
<td>
Odesíláné zpráv
</td>
<td>
<div class="form-check">
<input class="form-check-input" type="radio" name="up_messages-send" id="messages-send1" value="1" <?php echo $up_messages_send ? "checked" : "" ?>>
</div>
</td>
<td>
<div class="form-check">
<input class="form-check-input" type="radio" name="up_messages-send" id="messages-send0" value="0" <?php echo $up_messages_send ? "" : "checked" ?>>
</div>
</td>
</tr>
<tr>
<td>
Příjem zpráv
</td>
<td>
<div class="form-check">
<input class="form-check-input" type="radio" name="up_messages-recieve" id="messages-recieve1" value="1" <?php echo $up_messages_recieve ? "checked" : "" ?>>
</div>
</td>
<td>
<div class="form-check">
<input class="form-check-input" type="radio" name="up_messages-recieve" id="messages-recieve0" value="0" <?php echo $up_messages_recieve ? "" : "checked" ?>>
</div>
</td>
</tr>
<tr>
<td>
Správa společnosti
</td>
<td>
<div class="form-check">
<input class="form-check-input" type="radio" name="up_company-maintence" id="company-maintence1" value="1" <?php echo $up_company_maintence ? "checked" : "" ?>>
</div>
</td>
<td>
<div class="form-check">
<input class="form-check-input" type="radio" name="up_company-maintence" id="company-maintence0" value="0" <?php echo $up_company_maintence ? "" : "checked" ?>>
</div>
</td>
</tr>
<tr>
<td>
Správa registračních klíčů
</td>
<td>
<div class="form-check">
<input class="form-check-input" type="radio" name="up_reg-keys" id="reg-keys1" value="1" <?php echo $up_reg_keys ? "checked" : "" ?>>
</div>
</td>
<td>
<div class="form-check">
<input class="form-check-input" type="radio" name="up_reg-keys" id="reg-keys0" value="0" <?php echo $up_reg_keys ? "" : "checked" ?>>
</div>
</td>
</tr>
<tr>
<td>
Správa uživatelů
</td>
<td>
<div class="form-check">
<input class="form-check-input" type="radio" name="up_users" id="users1" value="1" <?php echo $up_users ? "checked" : "" ?>>
</div>
</td>
<td>
<div class="form-check">
<input class="form-check-input" type="radio" name="up_users" id="users0" value="0" <?php echo $up_users ? "" : "checked" ?>>
</div>
</td>
</tr>
<tr>
<td>
<b>Vybrat vše</b>
</td>
<td>
<div class="form-check">
<input class="form-check-input" type="radio" name="up_all" id="all1" value="1">
</div>
</td>
<td>
<div class="form-check">
<input class="form-check-input" type="radio" name="up_all" id="all0" value="0">
</div>
</td>
</tr>
</tbody>
</table>
</div>
<div class="form-group mb-3 d-flex">
<input type="submit" value="Uložit" class="btn btn-primary ms-auto" name="submitPrivileges">
</div>
</form>
</div>
</div>
</div> -->
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
/* $(document).ready(function(){
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
}); */
</script>
<script>
document.querySelector('#perm-select').addEventListener('change', function(){
document.querySelector('#login1').checked = false;
document.querySelector('#login0').checked = false;
document.querySelector('#messages-send1').checked = false;
document.querySelector('#messages-send0').checked = false;
document.querySelector('#messages-recieve1').checked = false;
document.querySelector('#messages-recieve0').checked = false;
document.querySelector('#company-maintence1').checked = false;
document.querySelector('#company-maintence0').checked = false;
document.querySelector('#reg-keys1').checked = false;
document.querySelector('#reg-keys0').checked = false;
document.querySelector('#users1').checked = false;
document.querySelector('#users0').checked = false;
switch (document.querySelector('#perm-select').value){
case '0':
document.querySelector('#login0').checked = true;
document.querySelector('#messages-send0').checked = true;
document.querySelector('#messages-recieve0').checked = true;
document.querySelector('#company-maintence0').checked = true;
document.querySelector('#reg-keys0').checked = true;
document.querySelector('#users0').checked = true;
break;
case '1':
document.querySelector('#login1').checked = true;
document.querySelector('#messages-send1').checked = true;
document.querySelector('#messages-recieve1').checked = true;
document.querySelector('#company-maintence0').checked = true;
document.querySelector('#reg-keys0').checked = true;
document.querySelector('#users0').checked = true;
break;
case '2':
document.querySelector('#login1').checked = true;
document.querySelector('#messages-send1').checked = true;
document.querySelector('#messages-recieve1').checked = true;
document.querySelector('#company-maintence1').checked = true;
document.querySelector('#reg-keys1').checked = true;
document.querySelector('#users1').checked = true;
break;
}
});
document.querySelector('#all1').addEventListener('click', function(){
document.querySelector('#login1').checked = true;
document.querySelector('#messages-send1').checked = true;
document.querySelector('#messages-recieve1').checked = true;
document.querySelector('#company-maintence1').checked = true;
document.querySelector('#reg-keys1').checked = true;
document.querySelector('#users1').checked = true;
document.querySelector('#all1').checked = false;
});
document.querySelector('#all0').addEventListener('click', function(){
document.querySelector('#login0').checked = true;
document.querySelector('#messages-send0').checked = true;
document.querySelector('#messages-recieve0').checked = true;
document.querySelector('#company-maintence0').checked = true;
document.querySelector('#reg-keys0').checked = true;
document.querySelector('#users0').checked = true;
document.querySelector('#all0').checked = false;
});
</script>
</body>
</html>
