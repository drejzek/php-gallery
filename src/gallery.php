<?php $index = true; $loginInPrivate = true;?>
<?php include 'config.php'?>
<?php include 'sess.php'?>

<?php

  $upperGalleryIdentifier = 0;

  $sql = "SELECT * FROM galleries WHERE identifier = '"  . $_GET['g'] . "' ORDER BY name ASC";
  $r = mysqli_query($conn, $sql);
  $gi = mysqli_fetch_array($r);

  $g = $gi['id'];

  $sql_ugi = "SELECT * FROM galleries WHERE id = " . $gi['upper_gallery_id'];
  $r_ugi = mysqli_query($conn, $sql_ugi);

  if($r_ugi->num_rows > 0)
    $upperGalleryIdentifier = mysqli_fetch_array($r_ugi)['identifier'];

  if(!isset($_SESSION['user_id'])){
    if($gi['is_locked'] && !isset($_SESSION['gallery-' . $gi['id']])){
      header('location: unlock/' . $gi['identifier']);
    }
  }
  else if($_SESSION['user_id'] != $gi['user_id']){
    if($gi['is_locked'] && !isset($_SESSION['gallery-' . $gi['id']])){
      header('location: unlock/' . $gi['identifier']);
    }
  }

  function toSlug($text) {
    // Převod na malá písmena
    $text = mb_strtolower($text, 'UTF-8');

    // Nahrazení diakritiky
    $text = strtr($text, [
        'ě' => 'e', 'š' => 's', 'č' => 'c', 'ř' => 'r', 'ž' => 'z', 
        'ý' => 'y', 'á' => 'a', 'í' => 'i', 'é' => 'e', 'ó' => 'o', 
        'ů' => 'u', 'ú' => 'u', 'ť' => 't', 'ň' => 'n', 'ď' => 'd', 
        'ĺ' => 'l', 'ľ' => 'l', 'ä' => 'a', 'ö' => 'o', 'ü' => 'u',
        'ť' => 't', 'ó' => 'o', 'ě' => 'e', 'ř' => 'r', 'ů' => 'u',
        'ň' => 'n', 'Ě' => 'e', 'Š' => 's', 'Č' => 'c', 'Ř' => 'r', 
        'Ž' => 'z', 'Ý' => 'y', 'Á' => 'a', 'Í' => 'i', 'É' => 'e',
        'Ó' => 'o', 'Ú' => 'u', 'Ů' => 'u', 'Ď' => 'd', 'Ť' => 't',
        'Ň' => 'n'
    ]);

    // Nahrazení všech ostatních nepísmen a čísel pomlčkami
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);

    // Odebrání přebytečných pomlček na začátku a na konci
    $text = trim($text, '-');

    return $text;
}


  if(isset($_POST['submit'])){
    $name = $_POST['gname'];
    $identifier = toSlug($name);
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
    
    $sql = "UPDATE galleries SET name = '$name', identifier = '$identifier', descr = '$descr', upper_gallery_id = '$upperGallery', is_private = '$private', is_locked = '$locked', is_def_places = '$defPlaces' WHERE id = " . $gi['id'];
    $r = mysqli_query($conn, $sql);

    if(!empty($_POST['gpwd'])){
        $sql = "UPDATE galleries SET password = '$pwd' WHERE identifier = '" . $_GET['g'] . "'";
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

  if(isset($_POST['file_submit'])){
    $id = $_POST['g_id'];
    $title = $_POST['title'];
    $alt = $_POST['alt_text'];

    $sql = "UPDATE files SET title = '$title', alt_text = '$alt' WHERE id = $id";
    $r = mysqli_query($conn, $sql);
  }


?>

<?php include 'assets/header.php'?>

<main>
  <?php if(!isset($_GET['edit'])):?>
  <div class="album py-5 bg-body-tertiary">
    <div class="container">
      <button onclick="location.href='<?php echo $gi['upper_gallery_id'] != 0 ? '../album/' . $upperGalleryIdentifier : '../' ?>'" class="btn btn-link"><i class="fas fa-arrow-alt-circle-left"></i></button>
      <div class="d-flex">
        <h1 class="fw-light mb-3 me-auto"><?php echo $gi['name']?></h1>
        <div class="ms-auto">
          <?php if(isset($_SESSION['user_id'])): ?>
          <div class="btn-group">
            <a href="../add-files.php?g=<?php echo $_GET['g']?>" class="btn btn-outline-primary"><i class="fas fa-plus me-2"></i> Přidat</a>
            <a href="<?php echo $_GET['g']?>/edit" class="btn btn-outline-primary"><i class="fas fa-pencil-alt me-2"></i> Upravit</a>
          </div>
          <?php endif;?>
        </div>
      </div>
      <?php
      
        $sql = "SELECT * FROM galleries WHERE upper_gallery_id = '" .  $gi['id'] . "' ORDER BY name ASC";
        if(mysqli_query($conn, $sql)->num_rows > 0):
      ?>
      <div class="d-flex mb-3">
        <h3 class="fw-light mb-3 me-auto cursor-pointer" data-bs-toggle="collapse" data-bs-target="#upperGalleries">Alba</h3>
        <i class="fas fa-chevron-down"></i>
      </div>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-5 collapse" id="upperGalleries">
        
        <?php

          if (isset($_SESSION['user_id'])) {

            $sql = "SELECT * FROM galleries WHERE user_id = '" . $_SESSION['user_id'] . "' AND upper_gallery_id = '" .  $gi['id'] . "' ORDER BY name ASC";
            $r = mysqli_query($conn, $sql);
            while($g = mysqli_fetch_array($r)){
              $id = $g['id'];
              $sql = "SELECT * FROM files WHERE gallery_id = $id AND is_thumbnail = '1'";
              $r1 = mysqli_query($conn, $sql);
              $photos = mysqli_query($conn, "SELECT * FROM files WHERE gallery_id = $id")->num_rows;
              if($photos == 1){
                $photos_text = "fotografie";
              }
              else if($photos > 1 && $photos < 5){
                $photos_text = "fotografie";
              }
              else if($photos >= 5 || $photos == 0){
                $photos_text = "fotografií";
              }
              if($r1->num_rows == 1){
                $path = mysqli_fetch_array($r1)['name'];
                $img = "<img src='../files/$path' class='card-img-top object-fit-cover' height='255' loading='lazy'>";
              }
              else{
                $img = '<svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">' . $g['name'] . '</text></svg>';
              }
              echo '
                <div class="col">
                  <div class="card shadow-sm">
                    ' . $img . '
                    <div class="card-body">
                      <h5 class="d-inline-block me-2">' . $g['name'] . '</h5>
                      ';
                      if($g['is_locked']){
                        echo '
                        <i class="fas fa-lock text-danger me-2"></i>
                        ';
                      }
                      else{
                        echo '
                        <i class="fas fa-unlock text-success me-2"></i>
                        ';
                      }
                      if($g['is_private']){
                        echo '
                        <i class="fas fa-eye-slash text-danger me-2"></i>
                        ';
                      }
                      else{
                        echo '
                        <i class="fas fa-eye text-success me-2"></i>
                        ';
                      }
                      echo '
                      <p class="card-text">' . $g['descr'] . '</p>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                          <a href="../album/' . $g['identifier'] . '" type="button" class="btn btn-sm btn-outline-secondary">Zobrazit</a>
                          <a href="../album/' . $g['identifier'] . '/edit" type="button" class="btn btn-sm btn-outline-secondary">Upravit</a>
                        </div>
                        <small class="text-body-secondary">' . $photos . ' ' . $photos_text . '</small>
                      </div>
                    </div>
                  </div>
                </div>
              
              ';
            } 
          }
          else{
            $sql = "SELECT * FROM galleries WHERE upper_gallery_id = '" .  $gi['id'] . "' ORDER BY name ASC";
            $r = mysqli_query($conn, $sql);
            while($g = mysqli_fetch_array($r)){
              $id = $g['id'];
              $sql = "SELECT * FROM files WHERE gallery_id = $id AND is_thumbnail = '1'";
              $r1 = mysqli_query($conn, $sql);
              $photos = mysqli_query($conn, "SELECT * FROM files WHERE gallery_id = $id")->num_rows;
              if($photos == 1){
                $photos_text = "fotografie";
              }
              else if($photos > 1 && $photos < 5){
                $photos_text = "fotografie";
              }
              else if($photos >= 5 || $photos == 0){
                $photos_text = "fotografií";
              }
              if($r1->num_rows == 1){
                $path = mysqli_fetch_array($r1)['name'];
                $img = "<img src='../files/$path' class='card-img-top object-fit-cover' height='255' loading='lazy'>";
              }
              else{
                $img = '<svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">' . $g['name'] . '</text></svg>';
              }
              echo '
                <div class="col">
                  <div class="card shadow-sm">
                    ' . $img . '
                    <div class="card-body">
                      <h5>' . $g['name'] . '</h5>
                      <p class="card-text">' . $g['descr'] . '</p>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                          <a href="../album/' . $g['identifier'] . '" type="button" class="btn btn-sm btn-outline-secondary">Zobrazit</a>
                        </div>
                        <small class="text-body-secondary">' . $photos . ' ' . $photos_text . '</small>
                      </div>
                    </div>
                  </div>
                </div>
              
              ';
            } 
          }
        
        ?>  

      </div>
        
      <?php endif;
      
        $sql = "SELECT * FROM files WHERE gallery_id = " .  $gi['id'];
        if(mysqli_query($conn, $sql)->num_rows > 0):
      
      ?>

      <div class="d-flex mb-3">
        <h3 class="fw-light mb-3 me-auto cursor-pointer" data-bs-toggle="collapse" data-bs-target="#photos">Fotografie</h3>
        <i class="fas fa-chevron-down"></i>
      </div>

      <!-- <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 collapse" id="photos"> -->
      <div class="row g-3 collapse" id="photos">
        <?php
          $sql = "SELECT * FROM files WHERE gallery_id = '" . $gi['id'] . "' ORDER BY id ASC";
          $r = mysqli_query($conn, $sql);
          $i = 0;
          while($g = mysqli_fetch_array($r)){
              echo '
              <a href="../files/' . $g['name'] . '?image=' . $i . '" class="col-sm-2 lightbox g-img" data-toggle="lightbox"  data-gallery="example-gallery" data-caption="' . $g['alt_text'] . '">
                  <img src="../files/' . $g['name'] . '?image=' . $i . '" alt="" class="g-img w-100 h-100 object-fit-cover" loading="lazy">
              </a>
              ';
              $i++;
          } 
        ?>  
      </div>
      <?php endif;?>
    </div>
  </div>
  <?php elseif(isset($_GET['edit']) && $gi['user_id'] == $_SESSION["user_id"]):?>
    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                    <div class="row mb-3 mt-5">
                        <form action="" method="post" class="mx-auto col-sm-6">
                            <div class="d-flex mb-3">
                                <h1 claess="fw-light mb-3 me-auto">Upravit galerii</h1>
                                <button class="btn" type="button" onclick="location.href='../<?php echo $gi['identifier']?>'"><i class="fas fa-arrow-alt-circle-left"></i></button>
                            </div>
                            <div class="form-group mb-3">
                                <label for="gname" class="form-label">Název galerie:</label>
                                <input type="text" name="gname" id="gname" class="form-control" value="<?php echo $gi['name']?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="gdescr" class="form-label">Popis galerie:</label>
                                <textarea rows="6" type="text" name="gdescr" id="gdescr" class="form-control"><?php echo $gi['descr']?></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="upperGallery" class="form-label">Nadřazená galerie</label>
                                <select name="upperGallery" id="upperGallery" class="form-select">
                                <option value="0"></option>
                                <?php
                                
                                    $sql = "SELECT * FROM galleries WHERE upper_gallery_id = 0";
                                    $r = mysqli_query($conn, $sql);
                                    while($g = mysqli_fetch_array($r)){
                                        echo '<option class="fw-bold" value="' . $g['id'] . '" ' . ($g['id'] == $gi['upper_gallery_id'] ? "selected" : "") . '>' . $g['name'] . '</option>';
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
                                    <input class="form-check-input" type="checkbox" role="switch" id="ispublic" name="field[0]" <?php echo $gi['is_private'] ? "checked" : ""?>>
                                    <label class="form-check-label" for="ispublic">Sukromá galerie</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="pwdrequired" name="field[1]" <?php echo $gi['is_locked'] ? "checked" : ""?>>
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
                        <div class="mx-auto col-sm-6">
                            <div class="d-flex bg-white border p-3 mb-3">
                                <h4>Smazat galerii/album</h4>
                                <div class="ms-auto">
                                    <form action="../../delete-gallery.php?g=<?php echo $gi['id']?>" method="post">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash-alt me-2"></i> Smazat
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="list-group">
                                <div class="list-group-item d-flex">
                                    <h4 class="me-auto">Nahrané soubory</h4>
                                    <a href="../../add-files.php?g=<?php echo $_GET['g']?>" class="btn btn-primary"><i class="fas fa-upload"></i> Nahrát</a>
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

                                        $sql = "SELECT * FROM files WHERE gallery_id = '" . $gi['id'] . "' ORDER BY id ASC";
                                        $r = mysqli_query($conn, $sql);
                                        while($g = mysqli_fetch_array($r)){
                                            echo '
                                                <div class="list-group-item">
                                                    <form class="d-flex" method="post">
                                                        <img src="../../files/' . $g['name'] . '" alt="" class="img-thumbnail g-img object-fit-cover me-3" onclick="openModal(../files/' . $g['name'] . ')" loading="lazy" style="width:120px;height:120px">
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
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <span class="modal-title">Upravit fotografii</span>
                                                                <button class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="row" method="post">
                                                                  <div class="col-sm-8">
                                                                    <img src="../../files/' . $g['name'] . '" alt="" class="me-3 w-100 h-100" onclick="openModal(files/' . $g['name'] . ')" loading="lazy">
                                                                  </div>
                                                                  <div class="col-sm-4">
                                                                      <span class="fw-bold">' . $g['name'] . '</span>
                                                                      <div class="form-group my-3">
                                                                        <label for="" class="form-label">Titulek</label>
                                                                        <input type="text" name="title" id="" class="form-control" value="' . $g['title'] . '">
                                                                      </div>
                                                                      <div class="form-group my-3">
                                                                        <label for="" class="form-label">Alternativní text</label>
                                                                        <input type="text" name="alt_text" id="" class="form-control" value="' . $g['alt_text'] . '">
                                                                      </div>
                                                                      <input type="submit" name="file_submit" id="" class="btn btn-success" value="Uložit">
                                                                      <br>
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
                            <div> 
                        </div>
                    </div>
                </div>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                    <div class="row mt-5">
                        <div class="col-sm-6 mx-auto">

                                
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                    <div class="row">
                        <div class="col-sm-6 mx-auto">
                            
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
            </div>
        </div>
      <?php endif;?>
</main>

<script type="module" src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js">

    import Lightbox from 'bs5-lightbox';

    const options = {
    keyboard: true,
    size: 'fullscreen'
    };

    document.querySelectorAll('.lightbox').forEach((el) => el.addEventListener('click', (e) => {
        e.preventDefault();
        const lightbox = new Lightbox(el, options);
        lightbox.show();
    }));
    
</script>

<?php include 'assets/footer.php'?>
