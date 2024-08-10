<?php

if(empty($conn)){
    header('location: install/');
}

$sql = "SELECT * FROM settings LIMIT 1";
$r_s = mysqli_query($conn, $sql);
$s = mysqli_fetch_array($r_s);

// Kontrola, zda session ještě nebyla spuštěna
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    if(!$index || $loginInPrivate && $s['gallery_private']){    
        header("Location: auth/");
        exit();
    }
}
else{
    if($admin && !$_SESSION['user_admin']){    
        header("Location: " . $s['gallery_url'] . "auth/");
        exit();
    }
    
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

// Zkontrolujeme, zda proměnná $search existuje, a pokud ne, nastavíme ji na prázdný řetězec
$search = isset($search) ? $search : '';
?>