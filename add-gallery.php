<?php

  include 'sess.php';
  include 'config.php';

  if(isset($_POST['submit'])){
    $name = $_POST['gname'];
    $descr = $_POST['gdescr'];
    $upperGallery = $_POST['upperGallery'];
    $pwd = $_POST['gpwd'];

    for($i=0;$i<2;$i++)
      $sfield[$i] = isset($_POST['field'][$i]) ? 1 : 0;

    $gid = rand(100000, 999999);
    
    $sql = "INSERT INTO `galleries`(`name`, `descr`, `upper_gallery_id`, `max_items_count`, `is_private`, `is_locked`, `password`, `gid`, `user_id`) VALUES ('$name', '$descr', '$upperGallery', '999', '" . $sfield[0] . "', '" . $sfield[1] . "', '" . md5($pwd) . "', '$gid','" . $_SESSION['user_id'] . "')";
    mysqli_query($conn, $sql);

    $sql = "SELECT * FROM galleries WHERE gid = '$gid'";
    header('location: add-files.php?g=' . mysqli_fetch_array(mysqli_query($conn, $sql))['id']);
  }

?>
<?php include 'assets/header.php'?>

    <main>
      <div class="album py-5 bg-body-tertiary">
        <div class="container">
          <div class="row">
            <form action="" method="post" class="col-sm-6 mx-auto">
              <div class="d-flex mb-3">
                <h1 class="fw-light mb-3 me-auto">Vytvořit galerii</h1>
                <button class="btn" type="button" onclick="location.href='.'"><i class="fas fa-arrow-alt-circle-left"></i></button>
              </div>
              <div class="form-group mb-3">
                <label for="gname" class="form-label">Název galerie:</label>
                <input type="text" name="gname" id="gname" class="form-control">
              </div>
              <div class="form-group mb-3">
                <label for="gname" class="form-label">Popis galerie:</label>
                <textarea rows="6" type="text" name="gdescr" id="gname" class="form-control"></textarea>
              </div>
              <div class="form-group mb-3">
                <label for="upperGallery" class="form-label">Nadřazená galerie</label>
                <select name="upperGallery" id="upperGallery" class="form-select">
                  <option value="0"></option>                  
                  <?php
                  
                  $sql = "SELECT * FROM galleries WHERE upper_gallery_id = 0";
                  $r = mysqli_query($conn, $sql);
                  while($g = mysqli_fetch_array($r)){
                      echo '<option class="fw-bold" value="' . $g['id'] . '">' . $g['name'] . '</option>';
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
                  <input class="form-check-input" type="checkbox" role="switch" id="ispublic" name="field[0]">
                  <label class="form-check-label" for="ispublic">Sukromá galerie</label>
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" id="pwdrequired" name="field[1]">
                  <label class="form-check-label" for="pwdrequired">Vyžadovat heslo</label>
                </div>
              </div>
              <div class="form-group mb-3">
                <label for="gname" class="form-label">Heslo:</label>
                <input type="password" name="gpwd" id="gpwd" class="form-control">
              </div>
              <div class="form-group">
                <input type="submit" value="Uložit" class="btn btn-success" name="submit">
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>

  <?php include 'assets/footer.php'?>
