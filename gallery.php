<?php $index = true; ?>
<?php include 'sess.php'?>
<?php include 'config.php'?>
<?php include 'assets/header.php'?>

<?php

  $sql = "SELECT * FROM galleries WHERE id = "  . $_GET['g'];
  $r = mysqli_query($conn, $sql);
  $gi = mysqli_fetch_array($r);

?>

<main>
  <div class="album py-5 bg-body-tertiary">
    <div class="container">
      <button onclick="location.href='<?php echo $gi['upper_gallery_id'] != 0 ? 'gallery.php?g=' . $gi['upper_gallery_id'] : '.' ?>'" class="btn btn-link"><i class="fas fa-arrow-alt-circle-left"></i></button>
      <div class="d-flex">
        <h1 class="fw-light mb-3 me-auto">g/<?php echo $gi['name']?></h1>
        <div class="ms-auto">
          <?php if(isset($_SESSION['user_id'])): ?>
          <div class="btn-group">
            <a href="add-files.php?g=<?php echo $_GET['g']?>" class="btn btn-outline-primary"><i class="fas fa-plus me-2"></i> Přidat</a>
            <a href="edit-gallery.php?g=<?php echo $_GET['g']?>" class="btn btn-outline-primary"><i class="fas fa-pencil-alt me-2"></i> Upravit</a>
          </div>
          <?php endif;?>
        </div>
      </div>
      <?php
      
        $sql = "SELECT * FROM galleries WHERE upper_gallery_id = " .  $gi['id'];
        if(mysqli_query($conn, $sql)->num_rows > 0):
      ?>
      <div class="d-flex mb-3">
        <h3 class="fw-light mb-3 me-auto cursor-pointer" data-bs-toggle="collapse" data-bs-target="#upperGalleries">Alba</h3>
        <i class="fas fa-chevron-down"></i>
      </div>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-5 collapse" id="upperGalleries">
        
        <?php

          if (isset($_SESSION['user_id'])) {

            $sql = "SELECT * FROM galleries WHERE user_id = '" . $_SESSION['user_id'] . "' AND upper_gallery_id = " .  $gi['id'];
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
          else{
            $sql = "SELECT * FROM galleries WHERE upper_gallery_id = " .  $gi['id'];
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
              else if($photos >= 5){
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
          $sql = "SELECT * FROM files WHERE gallery_id = '" . $_GET['g'] . "' ORDER BY id ASC";
          $r = mysqli_query($conn, $sql);
          $i = 0;
          while($g = mysqli_fetch_array($r)){
              echo '
              <a href="files/' . $g['name'] . '?image=' . $i . '" class="col-sm-2 lightbox g-img" data-toggle="lightbox"  data-gallery="example-gallery" data-caption="' . $g['alt_text'] . '">
                  <img src="files/' . $g['name'] . '?image=' . $i . '" alt="" class="g-img w-100 h-100 object-fit-cover" loading="lazy">
              </a>
              ';
              $i++;
          } 
        ?>  
      </div>
      <?php endif;?>
    </div>
  </div>
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
