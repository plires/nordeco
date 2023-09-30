<?php
  require_once( __DIR__ . '/vendor/autoload.php' );

	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/landing-2018/');
	$dotenv->safeLoad();

?>

<!DOCTYPE html>
<!--[if IE 9]> <html lang="es" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="es">
<!--<![endif]-->

<head>
  <!-- Tag Manager Head-->
  <?php include_once("includes/tag_manager_head.php") ?>
  <meta charset="utf-8">
  <title>Deck sintetico, deck plastico, deck ecologico, contacto</title>
  <meta name="description"
    content="pagina de contacto para enterarse de novedades sobre Decks ecologicos, sinteticos,.">
  <meta name="author" content="Libre">

  <!-- Mobile Meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Favicon -->
  <link rel="shortcut icon" href="images/favicon.ico">

  <!-- Equipo -->
  <link type="text/plain" rel="author" href="humans.txt" />

  <!-- Web Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic'
    rel='stylesheet'>
  <link href='http://fonts.googleapis.com/css?family=Raleway:700,400,300' rel='stylesheet'>
  <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet'>
  <link href='http://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet'>

  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">

  <!-- Font Awesome CSS -->
  <link href="fonts/font-awesome/css/font-awesome.css" rel="stylesheet">

  <!-- Fontello CSS -->
  <link href="fonts/fontello/css/fontello.css" rel="stylesheet">

  <!-- Plugins -->
  <link href="plugins/magnific-popup/magnific-popup.css" rel="stylesheet">
  <link href="css/animations.css" rel="stylesheet">
  <link href="plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
  <link href="plugins/owl-carousel/owl.transitions.css" rel="stylesheet">
  <link href="plugins/hover/hover-min.css" rel="stylesheet">

  <!-- recaptcha -->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

  <!-- The Project core CSS file -->
  <link href="css/style.css" rel="stylesheet">
  <!-- Color Scheme (In order to change the color scheme, replace the blue.css with the color scheme that you prefer)-->
  <link href="css/skins/light_blue.css" rel="stylesheet">

  <!-- Custom css -->
  <link href="css/custom.css" rel="stylesheet">

  <!-- Chatra {literal} -->
  <script>
  (function(d, w, c) {
    w.ChatraID = 'pk5jBQAMGW9CM47ki';
    var s = d.createElement('script');
    w[c] = w[c] || function() {
      (w[c].q = w[c].q || []).push(arguments);
    };
    s.async = true;
    s.src = 'https://call.chatra.io/chatra.js';
    if (d.head) d.head.appendChild(s);
  })(document, window, 'Chatra');
  </script>
  <!-- /Chatra {/literal} -->
</head>


<!-- body classes:  -->
<!-- "boxed": boxed layout mode e.g. <body class="boxed"> -->
<!-- "pattern-1 ... pattern-9": background patterns for boxed layout mode e.g. <body class="boxed pattern-1"> -->
<!-- "transparent-header": makes the header transparent and pulls the banner to top -->
<!-- "gradient-background-header": applies gradient background to header -->
<!-- "page-loader-1 ... page-loader-6": add a page loader to the page (more info @components-page-loaders.html) -->

<body class="no-trans    ">
  <!-- Tag Manager -->
  <?php include_once("includes/tag_manager_body.php") ?>

  <?php $current="contacto"; ?>

  <!-- scrollToTop -->
  <!-- ================ -->
  <div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>

  <!-- page wrapper start -->
  <!-- ================ -->
  <div class="page-wrapper">

    <?php include ("includes/header.inc"); ?>

    <!-- banner start -->
    <!-- ================ -->
    <div id="collapseMap" class="banner">
      <!-- google map start -->
      <!-- ================ -->
      <div id="map-canvas"></div>
      <!-- google maps end -->
    </div>
    <!-- banner end -->

    <!-- main-container start -->
    <!-- ================ -->
    <section class="main-container">

      <div class="container">
        <div class="row">

          <!-- main start -->
          <!-- ================ -->
          <div class="main col-md-8">
            <!-- page-title start -->
            <!-- ================ -->
            <h1 class="page-title">ENVIANOS TU <strong>CONSULTA</strong></h1>
            <div class="separator-2"></div>
            <!-- page-title end -->
            <p>
              Complete los datos del siguiente formulario. Nuestro equipo se pondrá en contacto con usted a la brevedad
              posible.
            </p>
            <div class="alert alert-success hidden" id="MessageSent">
              Hemos recibido su mensaje, nos pondremos en contacto con usted muy pronto.
            </div>
            <div class="alert alert-danger hidden" id="MessageNotSent">
              Ups! Algo salió mal por favor, actualiza la página y volve a intentarlo.
            </div>
            <div class="contact-form">

              <form method="POST" id="contact-form" class="margin-clear" action="./php/email-sender.php">
                <div class="form-group has-feedback">
                  <label for="name">Nombre*</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="">
                  <i class="fa fa-user form-control-feedback"></i>
                </div>
                <div class="form-group has-feedback">
                  <label for="email">Email*</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="">
                  <i class="fa fa-envelope form-control-feedback"></i>
                </div>
                <div class="form-group has-feedback">
                  <label for="message">Mensaje*</label>
                  <textarea class="form-control" rows="6" id="message" name="message" placeholder=""></textarea>
                  <i class="fa fa-pencil form-control-feedback"></i>
                </div>

                <!-- reCAPTCHA  -->
                <!-- <div id="recaptcha" class="g-recaptcha" data-sitekey="<?= $_ENV['RECAPTCHA_SITE_KEY'] ?>"></div> -->

                <input type="hidden" name="url" value="https://nordeco.com.ar/contacto.php">
                <input type="submit" value="Enviar" class="submit-button btn btn-default">
              </form>

            </div>
          </div>
          <!-- main end -->

          <!-- sidebar start -->
          <!-- ================ -->
          <aside class="col-md-4 col-lg-3 col-lg-offset-1">
            <div class="sidebar">
              <div class="block clearfix">
                <h3 class="title">Contactanos</h3>
                <div class="separator-2"></div>
                <ul class="list">
                  <!--<li><i class="fa fa-home pr-10"></i>795 Folsom Ave, Suite 600<br><span class="pl-20">San Francisco, CA 94107</span></li>-->
                  <!--<li><i class="fa fa-phone pr-10"></i><abbr title="Phone">P:</abbr> (123) 456-7890</li>-->
                  <!--<li><i class="fa fa-mobile pr-10 pl-5"></i><abbr title="Phone">M:</abbr> (123) 456-7890</li>-->
                  <li><i class="fa fa-envelope pr-10"></i><a href="mailto:info@nordeco.com.ar">info@nordeco.com.ar</a>
                  </li>
                </ul>
                <!--<a class="btn btn-gray collapsed map-show btn-animated" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap">Mostrar mapa <i class="fa fa-plus"></i></a>-->
              </div>
            </div>
            <div class="sidebar">
              <div class="block clearfix">
                <h2 class="title">Seguinos</h2>
                <div class="separator-2"></div>
                <ul class="social-links circle small margin-clear clearfix animated-effect-1">
                  <li class="facebook"><a target="_blank" href="http://www.facebook.com"><i
                        class="fa fa-facebook"></i></a></li>
                </ul>
              </div>
            </div>
          </aside>
          <!-- sidebar end -->

        </div>
      </div>
    </section>
    <!-- main-container end -->

    <!-- section start -->
    <!-- ================ -->
    <!-- <section class="section pv-40 dark-translucent-bg">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="call-to-action text-center">
              <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                  <h2 class="title">Suscribite a nuestro newsletter</h2>
                  <p>Enterate de las últimas novedades</p>
                  <div class="separator"></div>
                  <form method="POST" action="php/newsletter-sender.php" class="form-inline margin-clear">
                    <div class="form-group has-feedback">
                      <label class="sr-only" for="newsletter">Email</label>
                      <input type="email" class="form-control" id="newsletter" placeholder="Ingresar email"
                        name="newsletter" required="">
                      <input type="hidden" name="url-newsletter" value="http://nordeco.com.ar/contacto.php">
                      <i class="fa fa-envelope form-control-feedback"></i>
                    </div>
                    <button type="submit" class="btn btn-gray-transparent btn-animated margin-clear">Enviar <i
                        class="fa fa-send"></i></button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="clearfix"></div> -->
    <!-- section end -->

    <?php include ("includes/footer.inc"); ?>

  </div>
  <!-- page-wrapper end -->

  <!-- JavaScript files placed at the end of the document so the pages load faster -->
  <!-- ================================================== -->
  <!-- Jquery and Bootstap core js files -->
  <script type="text/javascript" src="plugins/jquery.min.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
  <!-- Modernizr javascript -->
  <script type="text/javascript" src="plugins/modernizr.js"></script>
  <!-- Magnific Popup javascript -->
  <script type="text/javascript" src="plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
  <!-- Appear javascript -->
  <script type="text/javascript" src="plugins/waypoints/jquery.waypoints.min.js"></script>
  <!-- Count To javascript -->
  <script type="text/javascript" src="plugins/jquery.countTo.js"></script>
  <!-- Parallax javascript -->
  <script src="plugins/jquery.parallax-1.1.3.js"></script>
  <!-- Contact form -->
  <script src="plugins/jquery.validate.js"></script>
  <!-- Google Maps javascript -->
  <script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false&amp;signed_in=true"></script>
  <script type="text/javascript" src="js/google.map.config.js"></script>
  <!-- Owl carousel javascript -->
  <script type="text/javascript" src="plugins/owl-carousel/owl.carousel.js"></script>
  <!-- SmoothScroll javascript -->
  <script type="text/javascript" src="plugins/jquery.browser.js"></script>
  <script type="text/javascript" src="plugins/SmoothScroll.js"></script>
  <!-- Initialization of Plugins -->
  <script type="text/javascript" src="js/template.js"></script>
  <!-- Mailchimp -->
  <script type="text/javascript" src="//downloads.mailchimp.com/js/signup-forms/popup/embed.js"
    data-dojo-config="usePlainJson: true, isDebug: false"></script>
  <script type="text/javascript">
  require(["mojo/signup-forms/Loader"], function(L) {
    L.start({
      "baseUrl": "mc.us17.list-manage.com",
      "uuid": "406cbe29a3e2f9eb2369a881b",
      "lid": "3c63e69616"
    })
  })
  </script>

</body>

</html>