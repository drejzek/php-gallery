<?php
    // Připojení k databázi
    $db_host = '10.147.20.90:3306';
    $db_name = 'max-online';
    $db_user = 'david';
    $db_pass = 'Rejzek22514';
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    
    // Kontrola připojení
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Dotaz na databázi
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    
    // Výpis výsledků do tabulky
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Časový rozdíl v sekundách
            $time_diff = time() - strtotime($row["last_activity"]);
            // Barva puntíku podle časového rozdílu
            $dot_color = ($time_diff < 5) ? 'bg-success' : 'bg-danger';
            $dot_text = ($time_diff < 5) ? 'Online' : 'Offline';
            echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["email"]."</td><td><span class='dot ".$dot_color."'></span><span class=\"small text-secondary ms-3\">" . $dot_text . "</sapn></td></tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No users found</td></tr>";
    }
    
    // Uzavření spojení s databází
    $conn->close();
?>