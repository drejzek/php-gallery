<?php

    // Kontrola připojení
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Dotaz na databázi
    $sql = "SELECT * FROM users WHERE id = " . $_GET['id'];
    $result = $conn->query($sql);
    
    // Výpis výsledků do tabulky
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc()
        $row["id"];
    } else {
        echo "<tr><td colspan='4'>No users found</td></tr>";
    }
    
    // Uzavření spojení s databází
    $conn->close();
?>