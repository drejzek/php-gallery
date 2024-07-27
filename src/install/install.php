<?php

$db_test = null;
$db_save_config = null;
$db_make_tables = null;
$db_save_user = null;
$db_save_settings = null;

// Assuming the form uses POST method and the action is install.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Step 2 fields
    $databaseHost = isset($_POST['databaseHost']) ? $_POST['databaseHost'] : '';
    $databaseName = isset($_POST['databaseName']) ? $_POST['databaseName'] : '';
    $databaseUser = isset($_POST['databaseUser']) ? $_POST['databaseUser'] : '';
    $databasePassword = isset($_POST['databasePassword']) ? $_POST['databasePassword'] : '';

    // Step 3 fields
    $userName = isset($_POST['userName']) ? $_POST['userName'] : '';
    $username = isset($_POST['userame']) ? $_POST['username'] : '';
    $userEmail = isset($_POST['userEmail']) ? $_POST['userEmail'] : '';
    $userPassword = isset($_POST['userPassword']) ? md5($_POST['userPassword']) : '';

    // Step 4 fields
    $galleryName = isset($_POST['galleryName']) ? $_POST['galleryName'] : '';
    $galleryURL = isset($_POST['galleryURL']) ? $_POST['galleryURL'] : '';
    $galleryDescr = isset($_POST['galleryDescr']) ? $_POST['galleryDescr'] : '';

    $con = mysqli_connect($databaseHost, $databaseUser, $databasePassword, $databaseName);

    function testMysqlConnection($host, $username, $password, $dbname) {
        // Create connection
        $conn = new mysqli($host, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            return false;
        } else {
            $conn->close();
            return true;
        }
    }

    function executeSqlFile($host, $username, $password, $dbname, $filePath) {
        // Create connection
        $conn = new mysqli($host, $username, $password, $dbname);
    
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        // Read the SQL file
        $sqlContent = file_get_contents($filePath);
        if ($sqlContent === false) {
            die("Failed to read the SQL file.");
        }
    
        // Split the file into individual queries
        $queries = explode(";", $sqlContent);
    
        // Execute each query
        foreach ($queries as $query) {
            $trimmedQuery = trim($query);
            if (!empty($trimmedQuery)) {
                if ($conn->query($trimmedQuery) === false) {
                    echo "Error executing query: " . $conn->error . "\n";
                }
            }
        }
    
        // Close the connection
        $conn->close();
    
        return true;
    }

    $connectionResult = testMysqlConnection($databaseHost, $databaseUser, $databasePassword, $databaseName);

    if ($connectionResult) {
        $db_test = 1;
        $config_content = "<?php\n";
        $config_content = "\$admin = 0;";
        $config_content .= "define('DB_HOST', '" . addslashes($databaseHost) . "');\n";
        $config_content .= "define('DB_NAME', '" . addslashes($databaseName) . "');\n";
        $config_content .= "define('DB_USER', '" . addslashes($databaseUser) . "');\n";
        $config_content .= "define('DB_PASSWORD', '" . addslashes($databasePassword) . "');\n";
        $config_content .= "\$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);";

        if (file_put_contents('../config.php', $config_content) !== false) {

            $db_save_config = 1;
            if(executeSqlFile($databaseHost, $databaseUser, $databasePassword, $databaseName, "php-gallery-strucuture.sql")){
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
                                '$username',
                                '$userEmail',
                                '1',
                                '0',
                                '1',
                                '0',
                                NULL,
                                '$userPassword'
                            )";
                $sql_settings = "INSERT INTO `settings`
                                (
                                    `gallery_name`,
                                    `gallery_descr`,
                                    `gallery_url`,
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
                                    '0',
                                    '0',
                                    '1',
                                    '0',
                                    '0',
                                    '1'
                                )";
                $r_user = mysqli_query($con, $sql_user);

                $r_settings = mysqli_query($con, $sql_settings);

                if($r_user){
                    $db_save_user = 1;
                }
                else{
                    $db_save_user = 0;
                }

                if($r_settings){
                    $db_save_settings = 1;
                }
                else{
                    $db_save_settings = 0;
                }

            }
            else{
                $db_make_tables = 0;
            }

        } else {
            $db_save_config = 0;
        }
    } else {
        $db_test = 0;
    }

    $progress = [
        "db_test" => $db_test,
        "db_save_config" => $db_save_config,
        "db_make_tables" => $db_make_tables,
        "db_save_user" => $db_save_user,
        "db_save_settings" => $db_save_settings
    ]; 

    // Store the progress array in the session
    $_SESSION['progress'] = $progress;

    // Redirect to the display page
    header("Location: display.php");
    exit();

}
?>

