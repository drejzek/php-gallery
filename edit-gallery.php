<?php

  include 'sess.php';
  include 'config.php';

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
        <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Základní informace</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Fotografie</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Možnosti</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                    <div class="row mb-3 mt-5">
                        <form action="" method="post" class="mx-auto col-sm-6">
                            <div class="d-flex mb-3">
                                <h1 class="fw-light mb-3 me-auto">Upravit galerii</h1>
                                <button class="btn" type="button" onclick="location.href='gallery.php?g=<?php echo $gd['id']?>'"><i class="fas fa-arrow-alt-circle-left"></i></button>
                            </div>
                            <div class="form-group mb-3">
                                <label for="gname" class="form-label">Název galerie:</label>
                                <input type="text" name="gname" id="gname" class="form-control" value="<?php echo $gd['name']?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="gname" class="form-label">Popis galerie:</label>
                                <textarea rows="6" type="text" name="gdescr" id="gname" class="form-control"><?php echo $gd['descr']?></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="upperGallery" class="form-label">Nadřazená galerie</label>
                                <select name="upperGallery" id="upperGallery" class="form-select">
                                <option value="0"></option>
                                <?php
                                
                                    $sql = "SELECT * FROM galleries WHERE upper_gallery_id = 0";
                                    $r = mysqli_query($conn, $sql);
                                    while($g = mysqli_fetch_array($r)){
                                        echo '<option class="fw-bold" value="' . $g['id'] . '" ' . ($g['id'] == $gd['upper_gallery_id'] ? "selected" : "") . '>' . $g['name'] . '</option>';
                                        $sql = "SELECT * FROM galleries WHERE upper_gallery_id = " . $g['id'];
                                        $r = mysqli_query($conn, $sql);
                                        while($g = mysqli_fetch_array($r))
                                            echo '<option value="' . $g['id'] . '">- ' . $g['name'] . '</option>';
                                    }
                                
                                ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="ispublic" name="field[0]" <?php echo $gd['is_private'] ? "checked" : ""?>>
                                    <label class="form-check-label" for="ispublic">Sukromá galerie</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="pwdrequired" name="field[1]" <?php echo $gd['is_locked'] ? "checked" : ""?>>
                                    <label class="form-check-label" for="pwdrequired">Vyžadovat heslo</label>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="gname" class="form-label">Heslo:</label>
                                <input type="password" name="gpwd" id="gpwd" class="form-control" placeholder="Nechcete-li měnit, ponechte pole prázdné">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success" name="submit"><i class="fas fa-save me-2"></i> Uložit</button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                    <div class="row mt-5">
                        <div class="col-sm-6 mx-auto">
                            <div class="list-group">
                                <div class="list-group-item d-flex">
                                    <h4 class="me-auto">Nahrané soubory</h4>
                                    <a href="add-files.php?g=<?php echo $_GET['g']?>" class="btn btn-primary"><i class="fas fa-upload"></i> Nahrát</a>
                                </div>
                                <?php
                                    /* $sql = "SELECT * FROM files WHERE gallery_id = '" . $_GET['g'] . "' ORDER BY id ASC";
                                    $r = mysqli_query($conn, $sql);
                                    while($g = mysqli_fetch_array($r)){
                                        echo '
                                            <div class="list-group-item">
                                                <form class="d-flex" method="post">
                                                    <img src="files/' . $g['name'] . '" alt="" class="img-thumbnail g-img object-fit-cover me-3" onclick="openModal(files/' . $g['name'] . ')" loading="lazy" style="width:120px;height:120px">
                                                    <div class="">
                                                        <span class="fw-bold">' . $g['name'] . '</span>
                                                        <br>
                                                        <span class="">' . $g['size'] . '</span>
                                                        <br>
                                                        <br>
                                                        <input type="hidden" value="' . $g['id'] . '" name="fid">
                                                        <input type="hidden" value="' . $g['name'] . '" name="fname">
                                                        <button class="btn btn-primary" type="submit" name="setAsThumbnail" ' . ($g['is_thumbnail'] ? 'disabled' : '') . '><i class="fas fa-image"></i> Nastavit jako náhled</button>
                                                        <button class="btn btn-danger" type="submit" name="delImg"><i class="fas fa-trash-alt"></i> Smazat</button>
                                                    </div>
                                                </form>
                                            </div>
                                        ';
                                    }  */

                                    $sql = "SELECT * FROM files WHERE gallery_id = '" . $_GET['g'] . "' ORDER BY id ASC";
                                    $r = mysqli_query($conn, $sql);
                                    while($g = mysqli_fetch_array($r)){
                                        echo '
                                            <div class="list-group-item">
                                                <form class="d-flex" method="post">
                                                    <img src="files/' . $g['name'] . '" alt="" class="img-thumbnail g-img object-fit-cover me-3" onclick="openModal(files/' . $g['name'] . ')" loading="lazy" style="width:120px;height:120px">
                                                    <div class="">
                                                        <span class="fw-bold">' . $g['name'] . '</span>
                                                        <br>
                                                        <span class="">' . ($g['is_thumbnail'] ? 'Náhledový obrázek' : '') . '</span>
                                                        <br>
                                                        <form method="post">
                                                            <button data-bs-toggle="modal" data-bs-target="#imgEdit' . $g['id'] . '" class="btn btn-lg" type="button" name=""><i class="fas fa-pencil-alt"></i></button>
                                                            <button class="btn text-danger" type="submit" name="delImg"><i class="fas fa-trash-alt"></i></button>
                                                            <input type="hidden" name="fid" id="" class="btn btn-success" value="' . $g['id'] . '">
                                                            <input type="hidden" name="fname" id="" class="btn btn-success" value="' . $g['name'] . '">
                                                            <input type="hidden" name="g_id" id="" class="btn btn-success" value="' . $g['id'] . '">
                                                        </form>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="modal" id="imgEdit' . $g['id'] . '">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <span class="modal-title">Upravit fotografii</span>
                                                            <button class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="d-flex" method="post">
                                                                <img src="files/' . $g['name'] . '" alt="" class="img-thumbnail g-img object-fit-cover me-3" onclick="openModal(files/' . $g['name'] . ')" loading="lazy" style="width:120px;height:120px">
                                                                <div class="w-100">
                                                                    <span class="fw-bold">' . $g['name'] . '</span>
                                                                    <div class="form-group my-3">
                                                                        <label for="" class="form-label">Alternativní text</label>
                                                                        <div class="input-group">
                                                                            <input type="text" name="alt_text" id="" class="form-control" value="' . $g['alt_text'] . '">
                                                                            <input type="submit" name="alt_textSubmit" id="" class="btn btn-success" value="Uložit">
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <button class="btn btn-primary" type="submit" name="setAsThumbnail" ' . ($g['is_thumbnail'] ? 'disabled' : '') . '><i class="fas fa-image"></i> Nastavit jako náhled</button>
                                                                    <button class="btn btn-danger" type="submit" name="delImg"><i class="fas fa-trash-alt"></i> Smazat</button>
                                                                    <input type="hidden" name="fid" id="" class="btn btn-success" value="' . $g['id'] . '">
                                                                    <input type="hidden" name="fname" id="" class="btn btn-success" value="' . $g['name'] . '">
                                                                    <input type="hidden" name="g_id" id="" class="btn btn-success" value="' . $g['id'] . '">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        ';
                                    } 
                                ?> 
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                    <div class="row">
                        <div class="col-sm-6 mx-auto">
                            <div class="container rounded border d-flex p-3">
                                <h4>Smazat galerii/album</h4>
                                <div class="ms-auto">
                                    <form action="delete-gallery.php?g=<?php echo $_GET['g']?>" method="post">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash-alt me-2"></i> Smazat
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
            </div>
        </div>
    </main>

  <?php include 'assets/footer.php'?>
