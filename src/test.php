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
          <div class="btn-group">
            <a href="add-files.php?g=<?php echo $_GET['g']?>" class="btn btn-outline-primary"><i class="fas fa-plus me-2"></i> Přidat</a>
            <a href="edit-gallery.php?g=<?php echo $_GET['g']?>" class="btn btn-outline-primary"><i class="fas fa-pencil-alt me-2"></i> Upravit</a>
          </div>
        </div>
      </div>

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" id="photos">
        <?php
            $sql = "SELECT * FROM files WHERE gallery_id = '" . $_GET['g'] . "' ORDER BY id ASC";
            $r = mysqli_query($conn, $sql);
            $i = 0;
            while($g = mysqli_fetch_array($r)){
                echo '
                <a href="files/' . $g['name'] . '?image=' . $i . '" class="lightbox g-img" data-toggle="lightbox"  data-gallery="example-gallery" data-caption="This describes the image">
                    <img src="files/' . $g['name'] . '?image=' . $i . '" alt="" class="g-img w-100 h-100 object-fit-cover" loading="lazy">
                </a>
                ';
                $i++;
            } 
        ?>  
      </div>
    </div>
  </div>
  <div class="modal fade" id="lightboxModal" tabindex="-1" aria-labelledby="lightboxModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <img src="" id="lightboxImage" class="img-fluid">
                <p id="lightboxAltText" class="mt-2"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="prevBtn">Previous</button>
                <button type="button" class="btn btn-secondary" id="nextBtn">Next</button>
            </div>
        </div>
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
