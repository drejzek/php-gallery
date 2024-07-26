<?php

    include 'config.php';
    $ds = DIRECTORY_SEPARATOR;  //1
    $storeFolder = 'files';   //2
    if (!empty($_FILES)) {
        $tempFile = $_FILES['file']['tmp_name'];          //3             
        $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
        $targetFile =  $targetPath. $_FILES['file']['name'];  //5
        move_uploaded_file($tempFile,$targetFile); //6
        $sql = "INSERT INTO `files`(`name`, `size`, `user_id`, `gallery_id`) VALUES ('" . $_FILES['file']['name'] . "', '0', '" . $_POST['user_id'] . "', '" . $_POST['gid'] . "')";
        if(mysqli_query($conn, $sql)){
            echo 'ok';
        }
        else{
            echo 'not ok';
        }
    }
    else{
        echo 'e';
    }

?>