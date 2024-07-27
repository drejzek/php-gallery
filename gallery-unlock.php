<?php
    $index = true;
    include 'sess.php';
    include 'config.php';

    $sql = "SELECT * FROM galleries WHERE id = "  . $_GET['g'];
    $r = mysqli_query($conn, $sql);
    $gi = mysqli_fetch_array($r);    

    if(isset($_POST['submit'])){
        $pwd = md5(trim($_POST['pwd']));

        if($pwd == $gi['password']){
           $_SESSION['gallery-' . $gi['id']] = true;
           header('location: gallery.php?g=' . $gi['id']);
        }
    }

?>
<?php include 'assets/header.php'?>

    <main>
        <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <h1 class="fw-light mb-3 me-auto">g/<?php echo $gi['name']?></h1>
            <div class="row mt-3">
                <div class="col-sm-6 mx-auto">
                <h4>Zadejte heslo k odemčení galerie</h4>
                <div class="row mt-3">
                    <div class="col-sm-8 mx-auto">
                        <form action="" method="post">
                            <div class="form-floating mb-3">
                                <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Zadejte heslo">
                                <label for="pwd" class="form-label">Zadejte heslo</label>
                            </div>
                            <div class="form-group d-grid">
                                <input type="submit" value="Odemknout" name="submit" class="btn btn-success btn-block">
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </main>

  <?php include 'assets/footer.php'?>
