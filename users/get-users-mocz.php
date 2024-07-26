<?php
    require_once '../config.php';    
    // Kontrola připojení
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $current_time = new DateTime();

    // Dotaz na databázi
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    
    // Výpis výsledků do tabulky
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {

            // Převod času poslední aktivity na DateTime objekt
            $last_activity_time = new DateTime($row['last_activity']);
            
            // Výpočet rozdílu času v sekundách
            $time_diff = $current_time->getTimestamp() - $last_activity_time->getTimestamp();
            
            // Určení statusu
            $activity = ($time_diff <= 5) ? 1 : 0;

            if($activity){
                $activity_color = "bg-success";
                $activity_text = "Online";
            }
            else{
                $activity_color = "bg-danger";
                $activity_text = "Offline";
            }

            $status = $row['banned'];
            $verified = $row['verified'];
            if($status == 0 && $verified == 1){
                $dot_color = "bg-success";
                $dot_text = "Aktivní";
            }
            else if($status == 0 && $verified == 0){
                $dot_color = "bg-warning";
                $dot_text = "Neověřený";
            }
            else if($status == 1 && $verified == 0){
                $dot_color = "bg-danger";
                $dot_text = "Blokovaný";
            }
            else{
                $dot_color = "bg-danger";
                $dot_text = "Blokovaný";
            }
            //DrJzJvAk
            echo "<tr>
                    <td>".$row["id"]."</td>
                    <td>".$row["name"]."</td>
                    <td>".$row["email"]."</td>
                    <td>
                        <span class='dot ".$dot_color."'></span>
                        <span class=\"small text-secondary ms-2\">" . $dot_text . "</sapn>
                    </td>
                    <!--<td>
                        <span class='dot ".$activity_color."'></span>
                        <span class=\"small text-secondary ms-2\">" . $activity_text . "</sapn>
                    </td>-->
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