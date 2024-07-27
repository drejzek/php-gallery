<?php

  include 'config.php';
  include 'sess.php';

  $gd = null;

  if(!isset($_POST['gid'])){
    //header('location: .');
  }

  if(isset($_POST['yes'])){
    for($i=0;$i<1;$i++)
      $sfield[$i] = isset($_POST['f'][$i]) ? 1 : 0;

    $keepSubGalleries = $sfield[0];

    $id = $_POST['id'];

    $sql = "SELECT * FROM galleries WHERE id = '$id'";
    $r = mysqli_query($conn, $sql);
    $g = mysqli_fetch_array($r);

    if($keepSubGalleries){
        echo $sql = "UPDATE galleries SET upper_gallery_id = '" . $g['upper_gallery_id'] . "' WHERE upper_gallery_id = '$id'";
        mysqli_query($conn, $sql);
    }
    else{
        $sql = "DELETE FROM galleries WHERE upper_gallery_id = '$id'";
        $r = mysqli_query($conn, $sql);
    }
    
    $sql = "DELETE FROM galleries WHERE id = '" . $_GET['g'] . "'";
    $r = mysqli_query($conn, $sql);

    header('location: .');
  }


?>
<?php include 'assets/header.php'?>

    <main>
        <div class="album py-5 bg-body-tertiary">
            <div class="row">
                <div class="col-sm-6 mx-auto">
                    <?php
                    
                        $sql = "SELECT * FROM galleries WHERE upper_gallery_id = '" . $_GET['g'] . "'";
                        $r = mysqli_query($conn, $sql);

                        if($r->num_rows > 0):
                    ?>
                    <div class="alert alert-danger">
                        <p><strong>POZOR</strong><br>
                        Tato galerie obsahuje další alba:</p>
                        <ul>
                            <?php
                                while($i = mysqli_fetch_array($r)){
                                    echo '<li>' . $i['name'] . '</li>';
                                }
                            ?>
                        </ul>
                        <p>Chcete li předejít smazámí i těchto alb použijte checkbox níže.</p>
                    </div>
                    <?endif;?>
                    <h4 class="text-center">
                        Opravdu si přejete smazat tuto galerii?
                    </h4>
                    <form action="" method="post" class="mt-3">
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="f[0]">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Zachovat obsahující alba/galerie
                                </label>
                            </div>
                            <div class="text-center">
                                <button name="no" type="submit" class="btn btn-success"><i class="fas fa-times"></i> Ne</button>        
                                <button name="yes" type="submit" class="btn btn-outline-danger"><i class="fas fa-check"></i> Ano</button>        
                                <input type="hidden" name="id" value="<?php echo $_GET['g']?>">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

  <?php include 'assets/footer.php'?>
