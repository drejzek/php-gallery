<?php

$admin = true;
include 'config.php';
include '../sess.php';

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

        $theme_bg_header_color = $_POST['theme_bg_header_color'];
        $theme_bg_page_color = $_POST['theme_bg_page_color'];
        $theme_bg_gallery_card_color = $_POST['theme_bg_gallery_card_color'];
        $theme_bg_footer_color = $_POST['theme_bg_footer_color'];
        $theme_font_color = $_POST['theme_font_color'];
        $theme_header_font_color = $_POST['theme_header_font_color'];
        
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
                    `allow_signup`='$allowSignUp',
                    `theme_bg_header_color`='$theme_bg_header_color',
                    `theme_bg_page_color`='$theme_bg_page_color',
                    `theme_bg_gallery_card_color`='$theme_bg_gallery_card_color',
                    `theme_bg_footer_color`='$theme_bg_footer_color',
                    `theme_font_color`='$theme_font_color',
                    `theme_header_font_color`='$theme_header_font_color'
                WHERE 1";

        $r = mysqli_query($conn, $sql);

        if($r){
            $htaccess = "ErrorDocument 404 " . $url . "etc/404.php\n"; 
            $htaccess .= "RewriteEngine On\n"; 
            $htaccess .= "RewriteBase $url\n"; 
            $htaccess .= "RewriteRule ^album/([a-zA-Z0-9-]+)$ gallery.php?g=$1 [L,QSA]\n"; 
            $htaccess .= "RewriteRule ^album/([a-zA-Z0-9-]+)/edit$ gallery.php?g=$1&edit [L,QSA]\n"; 
            $htaccess .= "RewriteRule ^album/unlock/([a-zA-Z0-9-]+)$ gallery-unlock.php?g=$1 [L,QSA]\n"; 
            $htaccess .= "RewriteRule ^user/([a-zA-Z0-9-]+)$ users/user.php?id=$1 [L,QSA]\n"; 
            $htaccess .= "RewriteRule ^profile users/profile.php [L,QSA]\n"; 
            $htaccess .= "RewriteRule ^add-gallery add-gallery.php [L,QSA]\n"; 
            file_put_contents("../.htaccess", $htaccess);
        }

    }

    if(isset($_POST['themeSubmit'])){
        $theme_id = $_POST['themeName'];

        $sql = "UPDATE settings SET gallery_theme = '$theme_id' WHERE id = 1";

        mysqli_query($conn, $sql);
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

                        <h5 class="mt-5">Šablona</h5>
                        <div class="container border p-3 bg-white d-flex">
                            <?php
                            
                                $name = $theme_data['theme_name'];
                                $author = $theme_data['theme_author'];
                                $ver = $theme_data['theme_version'];

                            ?>
                            <div class="me-auto">
                                <span class="fw-bold"><?php echo $name ?></span>
                                <br>
                                <span class=""><?php echo $author ?> • <?php echo $ver ?></span>
                            </div>
                            <div class="my-auto">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mThemes" type="button">Změnit</button>
                            </div>
                        </div>

                        <h5 class="mt-5">Barevné schéma</h5>
                        <ul class="list-group">
                            <li class="list-group-item d-flex">
                                <span class="me-auto">Barva pozadí hlavičky</span>
                                <input type="color" name="theme_bg_header_color" id="" value="<?php echo $s['theme_bg_header_color']?>">
                            </li>
                            <li class="list-group-item d-flex">
                                <span class="me-auto">Barva pozadí webu</span>
                                <input type="color" name="theme_bg_page_color" id="" value="<?php echo $s['theme_bg_page_color']?>">
                            </li>
                            <li class="list-group-item d-flex">
                                <span class="me-auto">Barva pozadí karty galerie</span>
                                <input type="color" name="theme_bg_gallery_card_color" id="" value="<?php echo $s['theme_bg_gallery_card_color']?>">
                            </li>
                            <li class="list-group-item d-flex">
                                <span class="me-auto">Barva pozadí patičky</span>
                                <input type="color" name="theme_bg_footer_color" id="" value="<?php echo $s['theme_bg_footer_color']?>">
                            </li>
                            <li class="list-group-item d-flex">
                                <span class="me-auto">Barva písma</span>
                                <input type="color" name="theme_font_color" id="" value="<?php echo $s['theme_font_color']?>">
                            </li>
                            <li class="list-group-item d-flex">
                                <span class="me-auto">Barva písma hlavičky</span>
                                <input type="color" name="theme_header_font_color" id="" value="<?php echo $s['theme_header_font_color']?>">
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

    <div class="modal" id="mThemes">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Šablony</h3>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="list-group">
                    <?php
                    
                        $themesDir = '../assets/themes';

                        // Získání všech souborů a složek v adresáři themes
                        $items = scandir($themesDir);

                        // Iterace přes všechny položky
                        foreach ($items as $item) {
                            // Přeskočení speciálních složek . a ..
                            if ($item === '.' || $item === '..') {
                                continue;
                            }

                            // Sestavení celé cesty k aktuální položce
                            $dirPath = $themesDir . '/' . $item;

                            // Zkontrolujeme, zda je položka složka
                            if (is_dir($dirPath)) {
                                // Cesta k manifest.json v dané složce
                                $manifestPath = $dirPath . '/manifest.json';
                                
                                // Zkontrolujeme, jestli manifest.json existuje
                                if (file_exists($manifestPath)) {
                                    // Načtení a dekódování JSON souboru
                                    $jsonContent = file_get_contents($manifestPath);
                                    $themeData = json_decode($jsonContent, true);

                                    // Výpis informací o tématu
                                    if ($themeData !== null) {
                                        echo '
                                        
                                            <div class="list-group-item">
                                                <form method="post">
                                                    <div class="row">
                                                        ';
                                                        if($themeData['theme_icon'] != ""){
                                                            echo '<div class="col-sm-3">
                                                                    <img src="" alt="" class="object-fit-cover w-100 h-100">
                                                                </div>';
                                                        }
                                                        echo '
                                                        <div class="col-sm-9">
                                                            <h4>' . $themeData['theme_name'] .'</h4>
                                                            <span class="text-small">' . $themeData['theme_author'] .' • ' . $themeData['theme_version'] .'</span>
                                                            <p class="">
                                                                ' . $themeData['theme_description'] .'
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="themeID" value="">
                                                    <input type="hidden" name="themeName" value="' . $themeData['theme_identifier'] .'">
                                                    <input type="submit" name="themeSubmit" value="Aktivovat" class="btn btn-primary">
                                                </form>
                                            </div>
                                        
                                        ';
                                    } else {
                                        echo 'Chyba při dekódování JSON v ' . $manifestPath . PHP_EOL;
                                    }
                                } else {
                                    echo 'manifest.json nebyl nalezen ve složce ' . $dirPath . PHP_EOL;
                                }
                            }
                        }            
                    ?>
                    </div>                    
                </div> 
            </div>
        </div>
    </div>

  <?php include '../assets/footer.php'?>
