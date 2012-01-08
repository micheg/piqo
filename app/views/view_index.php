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
    <h1 class="service_title"><?=$service; ?></h1>
    <div class="service_title">short your url!</div>
    <a href="http://micheg.blogspot.com"><img class="follow" src="img/blogspot.png" alt="follow me on blogspot"></a>
    </div>
  </header>

  <div role="content">
    <div class="wrap">
        <div class="grids">
            <div class="grid-12">
          <form action="/short/" method="post">
            <label for="long_url">your url</label>
            <input type='text' name="long_url" id="long_url" placeholder="http://www.example.com/long_url">
            <input type="submit" name="short" value="short it!" id="btn_short" class="butt blue">
            <label id ="lbl_short_url" for="short_url"></label>
            <input type="text" name="short_url" id="short_url" onFocus="this.select();">
          </form>
        </div>
        <div class="grid-12">
          <p>
            URL shortening is a technique on the World Wide Web in which a Uniform Resource Locator (URL) may be made substantially shorter in length and still direct to the required page. This is achieved by using an HTTP Redirect on a domain name that is short, which links to the web page that has a long URL. For example, the URL http://en.wikipedia.org/wiki/URL_shortening can be shortened to <?=$service; ?>urlwiki. This is especially convenient for messaging technologies such as Twitter and Identi.ca, which severely limit the number of characters that may be used in a message. Short URLs allow otherwise long web addresses to be referred to in a tweet.
          </p>
          <p>
            The use of <?=$service; ?> it is simple.
            it is sufficient to enter your long URL and click on "short it!" then copy your short url and paste it where you want.
          </p>
        </div>
        </div>
    </div>
  </div>
<br/><br/><br/><br/><br/>
  <footer role="footer">
    <div class="wrap">
    <p>
      <small>
      { <a href="http://www.slimframework.com/">Slim</a> a php microframework }
      { <a href="http://daneden.me/toast/">Toast</a> a simple CSS framework }
      { <a href="http://ender.no.de/">ender</a> the no-library library }
      { <a href="http://ender.no.de/">idiorm</a> a lightweight nearly-zero-configuration object-relational mapper and fluent query builder for PHP5 }
      <hr>
      <a href="https://github.com/micheg/piqo">Fork this project on github</a>
      </small>
    </p>

    </div>
  </footer>

  <script src="js/ender.min.js"></script>
  <script src="js/app.js"></script>
  <!--[if lt IE 7 ]>
    <script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script defer>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
</body>
</html>