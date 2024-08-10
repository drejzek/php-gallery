<?php

include 'config.php';
include 'sess.php';

  $gd = null;

  if(isset($_GET['g'])){
     $g= $_GET['g'];

     $sql = "SELECT * FROM galleries WHERE id = $g";

     $r = mysqli_query($conn, $sql);

     if($r->num_rows == 1)
     {
        $gd = mysqli_fetch_array($r);
     }

     if($_SESSION['user_id'] != $gd['user_id']){
        header('location: .');
        exit();
     }
  }

  if(isset($_POST['submit'])){
    $name = $_POST['gname'];
    $descr = $_POST['gdescr'];
    $upperGallery = $_POST['upperGallery'];
    $pwd = md5($_POST['gpwd']);

    for($i=0;$i<3;$i++)
      $sfield[$i] = isset($_POST['field'][$i]) ? 1 : 0;

    $private = $sfield[0];
    $locked = $sfield[1];
    $defPlaces = $sfield[2];

    if($defPlaces){
        $sql = "SELECT * FROM galleries WHERE is_def_places = '1'";

        $r = mysqli_query($conn, $sql);
    
        if($r->num_rows == 1){
            $sql = "UPDATE galleries SET is_def_places = 0";
            mysqli_query($conn, $sql);
        }
    }
    
    $sql = "UPDATE galleries SET name = '$name', descr = '$descr', upper_gallery_id = '$upperGallery', is_private = '$private', is_locked = '$locked', is_def_places = '$defPlaces' WHERE id = " . $_GET['g'];
    $r = mysqli_query($conn, $sql);

    if(!empty($_POST['gpwd'])){
        $sql = "UPDATE galleries SET password = '$pwd' WHERE id = " . $_GET['g'];
        $r = mysqli_query($conn, $sql);
    }
  }

  if(isset($_POST['delImg'])){
    $id = $_POST['fid'];
    $name = $_POST['fname'];

    $sql = "DELETE FROM files WHERE id = $id";
    if(mysqli_query($conn, $sql))
        unlink('files/' . $name);
  }

  if(isset($_POST['setAsThumbnail'])){
    $id = $_POST['fid'];

    $sql = "SELECT * FROM files WHERE is_thumbnail = '1' AND gallery_id = '$g'";

    $r = mysqli_query($conn, $sql);

    if($r->num_rows == 1){
        $sql = "UPDATE files SET is_thumbnail = '0' WHERE gallery_id = '$g'";
        mysqli_query($conn, $sql);
    }

    $sql = "UPDATE files SET is_thumbnail = '1' WHERE id = $id AND gallery_id = '$g'";
    mysqli_query($conn, $sql);
  }

  if(isset($_POST['alt_textSubmit'])){
    $id = $_POST['g_id'];
    $alt = $_POST['alt_text'];

    $sql = "UPDATE files SET alt_text = '$alt' WHERE id = $id";
    $r = mysqli_query($conn, $sql);
  }

?>
<?php include 'assets/header.php'?>

    <main>
    
    </main>

  <?php include 'assets/footer.php'?>
