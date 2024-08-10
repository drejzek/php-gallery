<?php

    include 'core.php';  

    // Step 2 fields
    $databaseHost = isset($_POST['databaseHost']) ? $_POST['databaseHost'] : '';
    $databaseName = isset($_POST['databaseName']) ? $_POST['databaseName'] : '';
    $databaseUser = isset($_POST['databaseUser']) ? $_POST['databaseUser'] : '';
    $databasePassword = isset($_POST['databasePassword']) ? $_POST['databasePassword'] : '';

    $con = mysqli_connect($databaseHost, $databaseUser, $databasePassword, $databaseName);

    $connectionResult = testMysqlConnection($databaseHost, $databaseUser, $databasePassword, $databaseName);

    if ($connectionResult) {
        echo 'db_test:1;';
    } else {
        echo 'db_test:0;';
    }