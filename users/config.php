<?php

$config = file_get_contents('../config.json');

$credentials = json_decode($config, true);

$db_host = $credentials['db_host'];
$db_name = $credentials['db_name'];
$db_user = $credentials['db_user'];
$db_pass = $credentials['db_pass'];

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
?>
