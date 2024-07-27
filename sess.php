<?php
// Kontrola, zda session ještě nebyla spuštěna
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Připojení konfiguračního souboru
require_once 'config.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    if(!$index){    
        header("Location: login.php");
        exit();
    }
}
else{
    $loggedInUserName = '';
    $loggedInUserId = $_SESSION['user_id'];

    if (!empty($loggedInUserId)) {
        $userSql = "SELECT username FROM users WHERE id = $loggedInUserId";
        $userResult = $conn->query($userSql);

        if ($userResult->num_rows > 0) {
            $userRow = $userResult->fetch_assoc();
            $loggedInUserName = $userRow['username'];
        }
    }
}

$sql = "SELECT * FROM settings";
$r_s = mysqli_query($conn, $sql);
$s = mysqli_fetch_array($r_s);

// Zkontrolujeme, zda proměnná $search existuje, a pokud ne, nastavíme ji na prázdný řetězec
$search = isset($search) ? $search : '';
?>