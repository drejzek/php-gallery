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
        $db_test = 1;
        $config_content = "<?php\n";
        $config_content .= "\$admin = 0;";
        $config_content .= "define('DB_HOST', '" . addslashes($databaseHost) . "');\n";
        $config_content .= "define('DB_NAME', '" . addslashes($databaseName) . "');\n";
        $config_content .= "define('DB_USER', '" . addslashes($databaseUser) . "');\n";
        $config_content .= "define('DB_PASSWORD', '" . addslashes($databasePassword) . "');\n";
        $config_content .= "\$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);";

        if (file_put_contents('../../config.php', $config_content) !== false) {
            echo 'config_file:1;';
        }
        else {
            echo 'config_file:0;';
        }
        echo 'db_test:1;';
    } else {
        echo 'db_test:0;';
    }