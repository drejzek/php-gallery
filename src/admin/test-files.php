<?php
// Připojení k databázi
include '../config.php';

// Zkontrolovat spojení
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Cesta ke složce s soubory
$folderPath = '../files/';

// Načíst seznam souborů ve složce
$folderFiles = array_diff(scandir($folderPath), array('.', '..'));

// Načíst seznam souborů z databáze
$sql = "SELECT `name` FROM `files`";
$result = $conn->query($sql);

$databaseFiles = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $databaseFiles[] = $row['name'];
    }
} else {
    echo "Žádné soubory v databázi.\n";
}

// Porovnat soubory ve složce a v databázi
$filesInFolderButNotInDb = array_diff($folderFiles, $databaseFiles);
$filesInDbButNotInFolder = array_diff($databaseFiles, $folderFiles);

// Výpis výsledků
if (!empty($filesInFolderButNotInDb)) {
    echo "Soubory ve složce, ale ne v databázi:<br><br>";
    foreach ($filesInFolderButNotInDb as $file) {
        echo $file . "<br><br>";
    }
} else {
    echo "Všechny soubory ve složce jsou v databázi.<br><br>";
}

if (!empty($filesInDbButNotInFolder)) {
    echo "Soubory v databázi, ale ne ve složce:<br><br>";
    foreach ($filesInDbButNotInFolder as $file) {
        echo $file . "<br><br>";
    }
} else {
    echo "Všechny soubory v databázi jsou ve složce.<br><br>";
}

// Zavřít připojení k databázi
$conn->close();
?>
