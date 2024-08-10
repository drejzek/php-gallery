<?php

if($admin && !$_SESSION['user_admin']){    
  header("Location: " . $s['gallery_url'] . "auth/");
  exit();
}

?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="David Rejzek">
    <meta name="theme-color" content="#712cf9">
    <title>Album example · Bootstrap v5.3</title>

    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="<?php echo $s['gallery_url']?>assets/bootstrap.css" rel="stylesheet">
    <link href="<?php echo $s['gallery_url']?>assets/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
      .dropzone {
        background: white;
        border-radius: 5px;
        border: 2px dashed rgb(0, 135, 247);
        border-image: none;
      }
      p, h1, h2, h3, h4. h5, h6{
        color: <?php echo $s['theme_font_color']?>
      }
      .g-img{
        max-width: 225px;
        max-height: 225px;
      }
      header{
        background-color: <?php echo $s['theme_bg_header_color']?>;
        border-color: <?php echo $s['theme_header_font_color']?>;
      }
      header > a, .nav > *{
        color: <?php echo $s['theme_header_font_color']?>;
      }
      .album{
        background-color: <?php echo $s['theme_bg_page_color']?>;
      }
      {
        color: inherit;
      }
    </style>
  </head>
  <body onload="coll()">
    <header class="p-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="<?php echo $s['gallery_url']?>" class="d-flex align-items-center mb-2 mb-lg-0 text-decoration-none pe-3 border-end me-3" style="color:<?php echo $s['theme_header_font_color']?>">
          <?php echo $s['gallery_name']?>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="<?php echo $s['gallery_url']?>" class="nav-link px-2" style="color:<?php echo $s['theme_header_font_color']?>">Overview</a></li>
        </ul>
        
        <?php if(isset($_SESSION['user_id']) && !$_SESSION['user_admin']): ?>
          <div class="dropdown text-end">
            <a href="#" class="d-block link-light text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              <?php echo $_SESSION['user_name'] ?>
            </a>
            <ul class="dropdown-menu text-small">
              <li><a class="dropdown-item" href="<?php echo $s['gallery_url']?>add-gallery">Nová galerie</a></li>
              <li><a class="dropdown-item" href="<?php echo $s['gallery_url']?>profile">Profil</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="<?php echo $s['gallery_url']?>auth/logout.php">Odhlásit se</a></li>
            </ul>
          </div>
          <?php elseif(isset($_SESSION['user_id']) && $_SESSION['user_admin']): ?>
            <div class="dropdown text-end">
              <a href="#" class="d-block link-light text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo $_SESSION['user_name'] ?>
              </a>
              <ul class="dropdown-menu text-small">
                <li><a class="dropdown-item" href="<?php echo $s['gallery_url']?>add-gallery">Nová galerie</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="<?php echo $s['gallery_url']?>users/">Uživatelé</a></li>
                <li><a class="dropdown-item" href="<?php echo $s['gallery_url']?>admin/settings.php">Nastavení</a></li>
                <li><a class="dropdown-item" href="<?php echo $s['gallery_url']?>profile">Profil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="<?php echo $s['gallery_url']?>auth/logout.php">Odhlásit se</a></li>
              </ul>
            </div>
          <?php else: ?>
            <div class="text-end">
              <a href="<?php echo $s['gallery_url']?>auth/" class="link-light text-decoration-none">Přihlásit se</a>
            </div>
          <?php endif; ?>
      </div>
    </div>
  </header>