<?php

include 'config.php';
include '../sess.php';

$sql = "SELECT * FROM settings LIMIT 1";
$r_s = mysqli_query($conn, $sql);
$s = mysqli_fetch_array($r_s);

if(isset($_POST['submit'])){
    $theme_bg_header_color = $_POST['theme_bg_header_color'];
    $theme_bg_page_color = $_POST['theme_bg_page_color'];
    $theme_bg_gallery_card_color = $_POST['theme_bg_gallery_card_color'];
    $theme_bg_footer_color = $_POST['theme_bg_footer_color'];
    $theme_font_color = $_POST['theme_font_color'];

    $sql = "UPDATE settings
            SET
                theme_bg_header_color = '$theme_bg_header_color',
                theme_bg_page_color = '$theme_bg_page_color',
                theme_bg_gallery_card_color = '$theme_bg_gallery_card_color',
                theme_bg_footer_color = '$theme_bg_footer_color',
                theme_font_color = '$theme_font_color'
            WHERE id = 1";
    mysqli_query($conn, $sql);
}

?>
<?php include '../assets/header.php'?>

    <main>
        <div class="album py-5 bg-body-tertiary">
            <div class="container">
                <h1 class="fw-light mb-3 me-auto">Upravit vzhled systému</h1>
                <form action="" class="row" method="post">
                    <ul class="list-group col-sm-6 mx-auto">
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
                            <input type="submit" value="Uložit" class="btn btn-success" name="submit">
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </main>

  <?php include '../assets/footer.php'?>
