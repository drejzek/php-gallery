<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db_host = $_POST['db_host'];
    $db_name = $_POST['db_name'];
    $db_user = $_POST['db_user'];
    $db_password = $_POST['db_password'];

    $config_content = "<?php\n";
    $config_content = "\$admin = 0;";
    $config_content .= "define('DB_HOST', '" . addslashes($db_host) . "');\n";
    $config_content .= "define('DB_NAME', '" . addslashes($db_name) . "');\n";
    $config_content .= "define('DB_USER', '" . addslashes($db_user) . "');\n";
    $config_content .= "define('DB_PASSWORD', '" . addslashes($db_password) . "');\n";
    $config_content .= "\$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);";

    if (file_put_contents('../config.php', $config_content) !== false) {
        echo "Konfigurace byla úspěšně uložena do souboru config.php.";
    } else {
        echo "Chyba při ukládání konfigurace.";
    }
} else {
    echo "Neplatný požadavek.";
}
?>
