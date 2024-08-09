<?php

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