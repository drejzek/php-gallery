<?php
    require_once 'config.php';    
    // Kontrola připojení
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Dotaz na databázi
    $sql = "SELECT * FROM users WHERE id = " . $_GET['id'];
    $result = $conn->query($sql);
    
    // Výpis výsledků do tabulky
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $status = $row['banned'];
            $dot_color = !$status ? 'bg-success' : 'bg-danger';
            $dot_text = !$status ? 'Aktivní' : 'Zablokovaný';
            echo '
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <b>Poslední aktivita</b>
                    </div>
                    <div class="col-sm-6">
                        ' . $row['last_activity'] . '
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <b>Poslední aktivia VM1</b>
                    </div>
                    <div class="col-sm-6">
                    ' . $row['VM1'] . '
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <b>Poslední aktivia VM2</b>
                    </div>
                    <div class="col-sm-6">
                    ' . $row['VM2'] . '
                    </div>
                </div>
                    ';
        }
    } else {
        echo "<tr><td colspan='4'>No users found</td></tr>";
    }
    
    // Uzavření spojení s databází
    $conn->close();
?>