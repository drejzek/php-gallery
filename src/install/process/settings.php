<?php

include 'core.php';

// Step 4 fields
$galleryName = isset($_POST['galleryName']) ? $_POST['galleryName'] : '';
$galleryURL = isset($_POST['galleryURL']) ? $_POST['galleryURL'] : '';
$galleryDescr = isset($_POST['galleryDescr']) ? $_POST['galleryDescr'] : '';

$databaseHost = isset($_POST['databaseHost']) ? $_POST['databaseHost'] : '';
$databaseName = isset($_POST['databaseName']) ? $_POST['databaseName'] : '';
$databaseUser = isset($_POST['databaseUser']) ? $_POST['databaseUser'] : '';
$databasePassword = isset($_POST['databasePassword']) ? $_POST['databasePassword'] : '';

$con = mysqli_connect($databaseHost, $databaseUser, $databasePassword, $databaseName);

$db_make_tables = 1;
$sql_settings = "INSERT INTO `settings`
                (
                    `gallery_name`,
                    `gallery_descr`,
                    `gallery_url`,
                    `gallery_theme`,
                    `gallery_default_private`,
                    `gallery_default_lock`,
                    `user_default_verify`,
                    `user_default_banned`,
                    `gallery_private`,
                    `allow_signup`
                )
                VALUES (
                    '$galleryName',
                    '$galleryDescr',
                    '$galleryURL',
                    'default',
                    '0',
                    '0',
                    '1',
                    '0',
                    '0',
                    '1'
                )";

$r_settings = mysqli_query($con, $sql_settings);

if($r_settings){
    echo 'settings:1;';
}
else{
    echo 'settings:0;';
}