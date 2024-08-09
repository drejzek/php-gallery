<?php

include 'core.php';

$databaseHost = isset($_POST['databaseHost']) ? $_POST['databaseHost'] : '';
$databaseName = isset($_POST['databaseName']) ? $_POST['databaseName'] : '';
$databaseUser = isset($_POST['databaseUser']) ? $_POST['databaseUser'] : '';
$databasePassword = isset($_POST['databasePassword']) ? $_POST['databasePassword'] : '';

// Step 3 fields
$userName = isset($_POST['userName']) ? $_POST['userName'] : '';
$userUserName = isset($_POST['username']) ? $_POST['username'] : '';
$userEmail = isset($_POST['userEmail']) ? $_POST['userEmail'] : '';
$userPassword = isset($_POST['userPassword']) ? md5($_POST['userPassword']) : '';

$con = mysqli_connect($databaseHost, $databaseUser, $databasePassword, $databaseName);

$db_make_tables = 1;
$sql_user = "INSERT INTO `users`
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
                '$userName',
                '$userUserName',
                '$userEmail',
                '1',
                '0',
                '1',
                '0',
                NULL,
                '$userPassword'
            )";

$r_user = mysqli_query($con, $sql_user);

if($r_user){
    echo 'user:1;';
}
else{
    echo 'user:0;';
}