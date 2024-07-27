<?php

$admin = true;
include '../sess.php';
include 'config.php';

  $gd = null;

    $sql = "SELECT * FROM settings WHERE id = 1";

    $r = mysqli_query($conn, $sql);

    if($r->num_rows == 1)
    {
        $gd = mysqli_fetch_array($r);
    }

    if(isset($_POST['submit'])){
        $name = $_POST['gname'];
        $descr = $_POST['gdescr'];
        $url = $_POST['gurl'];

        for($i=0;$i<6;$i++)
        $sfield[$i] = isset($_POST['field'][$i]) ? 1 : 0;

        $private = $sfield[0];
        $allowSignUp = $sfield[1];
        $defPrivateGallery = $sfield[2];
        $defPassRequired = $sfield[3];
        $defUserVerify = $sfield[4];
        $defUserBlock = $sfield[5];
        
        $sql = "UPDATE `settings`
                SET
                    `gallery_name`='$name',
                    `gallery_descr`='$descr',
                    `gallery_url`='$url',
                    `gallery_default_private`='$defPrivateGallery',
                    `gallery_default_lock`='$defPassRequired',
                    `user_default_verify`='$defUserVerify',
                    `user_default_banned`='$defUserBlock',
                    `gallery_private`='$private',
                    `allow_signup`='$allowSignUp'
                WHERE 1";

        $r = mysqli_query($conn, $sql);
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
<?php include '../assets/header.php'?>

    <main>
        <div class="album py-5 bg-body-tertiary">
            <div class="container">
                <div class="row mb-3">
                    <form action="" method="post" class="mx-auto col-sm-6">
                        <div class="d-flex mb-3">
                            <h1 class="fw-light mb-3 me-auto">Nastavení systému</h1>
                            <button class="btn" type="button" onclick="location.href='.'"><i class="fas fa-arrow-alt-circle-left"></i></button>
                        </div>
                        <div class="form-group mb-3">
                            <label for="gname" class="form-label">Název galerie:</label>
                            <input type="text" name="gname" id="gname" class="form-control" value="<?php echo $gd['gallery_name']?>">
                        </div>
                        <div class="form-group mb-3">
                            <label for="gurl" class="form-label">URL adresa:</label>
                            <input type="text" name="gurl" id="gname" class="form-control" value="<?php echo $gd['gallery_url']?>">
                        </div>
                        <div class="form-group mb-3">
                            <label for="gname" class="form-label">Popis galerie:</label>
                            <textarea rows="3" type="text" name="gdescr" id="gname" class="form-control"><?php echo $gd['gallery_descr']?></textarea>
                        </div>                        
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" role="switch" id="pwdrequired" name="field[0]" <?php echo $gd['gallery_private'] ? "checked" : ""?>>
                            <label class="form-check-label" for="pwdrequired">Soukromá galerie</label>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" role="switch" id="allowUserSignUp" name="field[1]" <?php echo $gd['allow_signup'] ? "checked" : ""?>>
                            <label class="form-check-label" for="allowUserSignUp">Povolit registraci uživatelů</label>
                        </div>
                        

                        <h5 class="mt-5">Výchozí hodnoty pro nové galerie</h5>
                        <ul class="list-group">
                            <li class="list-group-item d-flex">
                                <label for="privateGallery">Soukromá galerie</label>
                                <div class="form-check form-switch ms-auto">
                                    <input class="form-check-input" type="checkbox" role="switch" id="privateGallery" name="field[2]" <?php echo $gd['gallery_default_private'] ? "checked" : ""?>>
                                </div>
                            </li>
                            <li class="list-group-item d-flex">
                                <label for="passRequired">Vyžadovat heslo</label>
                                <div class="form-check form-switch ms-auto">
                                    <input class="form-check-input" type="checkbox" role="switch" id="passRequired" name="field[3]" <?php echo $gd['gallery_default_lock'] ? "checked" : ""?>>
                                </div>
                            </li>
                        </ul>

                        <h5 class="mt-5">Výchozí hodnoty pro nové uživatele</h5>
                        <ul class="list-group">
                            <li class="list-group-item d-flex">
                                <label for="verifyUser">Ověřit uživatele</label>
                                <div class="form-check form-switch ms-auto">
                                    <input class="form-check-input" type="checkbox" role="switch" id="verifyUser" name="field[4]" <?php echo $gd['user_default_verify'] ? "checked" : ""?>>
                                </div>
                            </li>
                            <li class="list-group-item d-flex">
                                <label for="blockUser">Zablokovat uživatele</label>
                                <div class="form-check form-switch ms-auto">
                                    <input class="form-check-input" type="checkbox" role="switch" id="blockUser" name="field[5]" <?php echo $gd['user_default_banned'] ? "checked" : ""?>>
                                </div>
                            </li>
                        </ul>

                        <div class="form-group mt-5">
                            <button type="submit" class="btn btn-success" name="submit"><i class="fas fa-save me-2"></i> Uložit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

  <?php include '../assets/footer.php'?>
