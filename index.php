<?php $index = true; ?>
<?php include 'sess.php'?>
<?php include 'config.php'?>
<?php include 'assets/header.php'?>


<main>
  <div class="album py-5 bg-body-tertiary">
    <div class="container">
      <div class="d-flex">
        <h1 class="fw-light mb-3 me-auto">Moje galerie</h1>
        <div class="ms-auto">
          <?php if(isset($_SESSION['user_id'])): ?>
          <a href="add-gallery.php" class="btn btn-outline-primary"><i class="fas fa-plus me-2"></i> Přidat</a>
          <?php endif;?>
        </div>
      </div>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        
        <?php

          if (isset($_SESSION['user_id'])) {
        
            $sql = "SELECT * FROM galleries WHERE user_id = '" . $_SESSION['user_id'] . "' AND upper_gallery_id = '0'";
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
                $img = "<img src='files/$path' class='card-img-top object-fit-cover' height='255' loading='lazy'>";
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
                          <a href="gallery.php?g=' . $g['id'] . '" type="button" class="btn btn-sm btn-outline-secondary">Zobrazit</a>
                          <a href="edit-gallery.php?g=' . $g['id'] . '" type="button" class="btn btn-sm btn-outline-secondary">Upravit</a>
                        </div>
                        <small class="text-body-secondary">' . $photos . ' ' . $photos_text . '</small>
                      </div>
                    </div>
                  </div>
                </div>
              
              ';
            } 
          }
          else {
          
            $sql = "SELECT * FROM galleries WHERE is_private = '0' AND upper_gallery_id = '0'";
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
                $img = "<img src='files/$path' class='card-img-top object-fit-cover' height='255' loading='lazy'>";
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
                          <a href="gallery.php?g=' . $g['id'] . '" type="button" class="btn btn-sm btn-outline-secondary">Zobrazit</a>
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
    </div>
  </div>
</main>

<?php include 'assets/footer.php'?>
