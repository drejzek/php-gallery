<?php include 'config.php'?>
<?php

    $gid = $_GET['g'];

    $sql = "SELECT * FROM galleries WHERE id = $gid";

    $r = mysqli_query($conn, $sql);

    $name = mysqli_fetch_array($r)['name'];

?>

<?php include 'sess.php'?>
<?php include 'assets/header.php'?>

    <main>
        <div class="album py-5 bg-body-tertiary">
            <div class="container">
                <div class="d-flex mb-5">
                    <div class="container">
                        <h1 class="fw-light me-auto">Nahrát soubory</h1>
                        <h4 class="fw-light">g/<?php echo $name ?></h4>
                    </div>
                    <a href="gallery.php?g=<?php echo $_GET['g']?>" class="btn">Pokračovat</a>
                </div>
                <div id="dropzone" class="w-100">
                    <form class="dropzone needsclick w-100" id="demo-upload" action="upload.php" name="upload">
                        <div class="dz-message needsclick">    
                            Přesuňte soubory sem nebo klikněte pro nahrání.<br>
                        </div>
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']?>">
                        <input type="hidden" name="gid" value="<?php echo $_GET['g']?>">
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>var dropzone = new Dropzone('#demo-upload', {
        previewTemplate: document.querySelector('#preview-template').innerHTML,
        parallelUploads: 2,
        thumbnailHeight: 120,
        thumbnailWidth: 120,
        maxFilesize: 3,
        filesizeBase: 1000,
        thumbnail: function(file, dataUrl) {
            if (file.previewElement) {
            file.previewElement.classList.remove("dz-file-preview");
            var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
            for (var i = 0; i < images.length; i++) {
                var thumbnailElement = images[i];
                thumbnailElement.alt = file.name;
                thumbnailElement.src = dataUrl;
            }
            setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
            }
        }

        });


        // Now fake the file upload, since GitHub does not handle file uploads
        // and returns a 404

        var minSteps = 6,
            maxSteps = 60,
            timeBetweenSteps = 100,
            bytesPerStep = 100000;

        dropzone.uploadFiles = function(files) {
        var self = this;

        for (var i = 0; i < files.length; i++) {

            var file = files[i];
            totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));

            for (var step = 0; step < totalSteps; step++) {
            var duration = timeBetweenSteps * (step + 1);
            setTimeout(function(file, totalSteps, step) {
                return function() {
                file.upload = {
                    progress: 100 * (step + 1) / totalSteps,
                    total: file.size,
                    bytesSent: (step + 1) * file.size / totalSteps
                };

                self.emit('uploadprogress', file, file.upload.progress, file.upload.bytesSent);
                if (file.upload.progress == 100) {
                    file.status = Dropzone.SUCCESS;
                    self.emit("success", file, 'success', null);
                    self.emit("complete", file);
                    self.processQueue();
                    //document.getElementsByClassName("dz-success-mark").style.opacity = "1";
                }
                };
            }(file, totalSteps, step), duration);
            }
        }
        }
    </script>

  <?php include 'assets/footer.php'?>
