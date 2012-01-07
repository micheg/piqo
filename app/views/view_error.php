<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title><?=$service; ?> short your url!</title>
  <meta name="description" content="<?=$service; ?> short your url">
  <meta name="author" content="Michelangelo Giacomelli">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="css/toast.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <header role="banner">
    <div class="wrap">
    <h1 class="service_title"><?= $service ?></h1>
    <div class="service_title">short your url!</div>
    <a href="http://micheg.blogspot.com"><img class="follow" src="img/blogspot.png" alt="follow me on blogspot"></a>
    </div>
  </header>

  <div role="content">
    <div class="wrap">
      <div class="grid-12">
        <h1>error</h1>
        <p>404: Page not found – the page <?php echo $url; ?> does not exist.</p>
        <p>If you typed in or copied/pasted this URL, make sure you included all the characters, with no extra punctuation.</p>
      </div>
    </div>
    </div>

  <script src="js/ender.min.js"></script>
  <script src="js/app.js"></script>
  <!--[if lt IE 7 ]>
    <script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script defer>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
</body>
</html>