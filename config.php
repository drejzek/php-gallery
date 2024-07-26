<?php
$credentials = json_decode(file_get_contents('config.json'), true);

$db_host = $credentials['db_host'];
$db_name = $credentials['db_name'];
$db_user = $credentials['db_user'];
$db_pass = $credentials['db_pass'];

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
?>
