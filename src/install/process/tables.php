<?php

include 'core.php';

$databaseHost = isset($_POST['databaseHost']) ? $_POST['databaseHost'] : '';
$databaseName = isset($_POST['databaseName']) ? $_POST['databaseName'] : '';
$databaseUser = isset($_POST['databaseUser']) ? $_POST['databaseUser'] : '';
$databasePassword = isset($_POST['databasePassword']) ? $_POST['databasePassword'] : '';

if(executeSqlFile($databaseHost, $databaseUser, $databasePassword, $databaseName, "../php-gallery-strucuture.sql")){
    echo 'tables:1;';
}
else{
    echo 'tables:0;';
}