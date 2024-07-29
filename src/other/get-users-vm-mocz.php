<?php
    require_once 'config.php';    
    // Kontrola připojení
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Dotaz na databázi
    $sql = "SELECT * FROM users ORDER BY VM1 DESC";
    $result = $conn->query($sql);
    
    // Výpis výsledků do tabulky
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $status = $row['banned'];
            $dot_color = !$status ? 'bg-success' : 'bg-danger';
            $dot_text = !$status ? 'Aktivní' : 'Zablokovaný';
            echo "<tr>
                    <td>".$row["id"]."</td>
                    <td>".$row["username"]."</td>
                    <td>".$row["VM1"]."</td>
                    <td>".$row["VM2"]."</td>
                    <td class=\"text-center\"><a class=\"btn btn-sm\" href=\"user.php?id=" . $row["id"] . "\"><i class=\"fas fa-pencil\"></i></a></td>
                </tr>
                    ";
        }
    } else {
        echo "<tr><td colspan='4'>No users found</td></tr>";
    }
    
    // Uzavření spojení s databází
    $conn->close();
?>