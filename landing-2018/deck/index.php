<!-- formulario -->
<?php

	require_once( __DIR__ . '/../vendor/autoload.php' );
	include_once( __DIR__ . '/../clases/app.php' );

	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
	$dotenv->safeLoad();
	define('PERFIT_INTEREST', 2);

	$errors=array();
	$name="";
	$email="";
	$phone="";
	$comments="";
	$rubro="";
	$origin="";

	/*Si el post viene por el formulario de contacto*/
	if (isset($_POST['send'])){
		include ('./../includes/funciones_validar.php');

		//Comprobamos el reCaptcha
		include_once("./../includes/recaptcha.php");

		if(campoVacio($_POST['name'])){
			$errors['name']='Ingresa tu nombre';
		} else {
			$name = $_POST['name'];
		}

		if (!comprobar_email($_POST['email'])){
			$errors['email']='Ingresa un email valido';
		} else {
			$email = $_POST['email'];
		}

		if(campoVacio($_POST['phone'])){
			$errors['phone']='Ingresa tu teléfono';
		} else {
			$phone = $_POST['phone'];
		}

		if(campoVacio($_POST['comments'])){
			$errors['comments']='Ingresa tu Comentario';
		} else {
			$comments = $_POST['comments'];
		}

		if (count($errors) === 0){

			$app = new App;
			// Registramos en Perfit el contacto
			$app->registerEmailContactsInPerfit($_ENV['PERFIT_APY_KEY'], $_ENV['PERFIT_LIST'], $_POST);
			
			// Grabar en la base de datos
			$app->saveInBDD($_ENV['DSN'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_POST);

			// Enviamos los correos:
			$send = $app->sendEmail($_POST, 'cliente', 'Presupuesto Deck Ecológico');
			$app->sendEmail($_POST, 'usuario', 'Gracias por tu contacto');

			if ($send) {
			?>
<script type="text/javascript">
window.location = 'gracias.php';
</script>
<?php
			}
			
		}

	}

?>

<!doctype html>
<html lang="es">

<head>
  <!-- Tag Manager Head -->
  <?php include_once("../includes/tag_manager_head.inc") ?>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="deck ecologico mejor que madera, sin mantenimiento.">

  <!-- Favicons -->
  <link rel="apple-touch-icon" href="img/apple-icon.png">
  <link rel="icon" href="img/favicon.png">

  <!-- Normalize CSS -->
  <link rel="stylesheet" type="text/css" href="./../css/normalize.min.css">

  <!-- Bootstrap Grid CSS -->
  <link rel="stylesheet" type="text/css" href="./../css/bootstrap.min.css">

  <!-- Animated CSS -->
  <link rel="stylesheet" type="text/css" href="./../css/animate.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="css/app.css">

  <!-- recaptcha -->
  <script src='https://www.google.com/recaptcha/api.js'></script>

  <title>Deck Ecologicos trex</title>

</head>

<body>
  <!-- Tag Manager Body -->
  <?php include_once("../includes/tag_manager_body.inc") ?>

  <!-- HEADER -->
  <header id="header" class="container">
    <div class="row">

      <div class="col-md-6 wow fadeIn">
        <img src="img/logo-nordeco.png" alt="logo nordeco">
      </div>

      <div class="col-md-6 wow fadeIn header_datos hidden_phone">
        <a class="transition email" href="mailto:info@nordeco.com.ar">info@nordeco.com.ar</a>
      </div>

    </div>
  </header>
  <!-- HEADER end -->

  <!-- FORMULARIO MOBILE -->
  <section class="container mb_30 formulario_mobile">

    <div class="row">
      <div class="col-md-12">
        <img class="img-fluid wow fadeInLeft" src="img/header-mobile.jpg">
        <h1 class="wow fadeInLeft">LÍNEA <br><strong>DECKS ECOLÓGICOS</strong></h1>
        <img class="mb_15 wow fadeInUp" src="img/trex-mobile.png" alt="deck trex mobile">
        <form id="formulario_mobile" class="formulario text-left wow fadeIn" method="post">
          <h2 class="h2_formulario">¿Necesitas cotizar un deck ecológico?</h2>
          <h3 class="h3_formulario">Envianos tú consulta hoy mismo!</h3>

          <input name="rubro" type="hidden" value="Deck Ecologico">
          <input name="origin" type="hidden" value="Landing Deck Ecologicos">
          <input name="path" type="hidden" value="deck">

          <div class="form-group">
            <input required name="name" type="text" class="form-control" placeholder="Ingresá tu nombre"
              value="<?= $name ?>">
          </div>

          <div class="form-group">
            <input required name="email" type="email" class="form-control" placeholder="Ingresá tu email"
              value="<?= $email ?>">
          </div>

          <div class="form-group">
            <input required name="phone" type="tel" class="form-control" placeholder="Ingresá tu teléfono"
              value="<?= $phone ?>">
          </div>

          <textarea required class="form-control" name="comments" rows="4"
            placeholder="Que necesitás?"><?= $comments ?></textarea>

          <div class="form-group form-check">
            <input checked name="newsletter" type="checkbox" value="Si" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Suscribir newsletter</label>
          </div>

          <!-- reCAPTCHA  -->
          <div id="recaptcha" class="g-recaptcha" data-sitekey="<?= $_ENV['RECAPTCHA_SITE_KEY'] ?>"></div>

          <div class="text-center">
            <input id="send" name="send" type="submit" value="ENVIAR" class="btn btn-primary transition">
          </div>

          <div class="error">
            <ul>
              <?php foreach ($errors as $error) { ?>
              <li><?php echo $error; ?></li>
              <?php } ?>
            </ul>
          </div>
        </form>

      </div>
    </div>

  </section>
  <!-- FORMULARIO MOBILE end-->

  <!-- FORMULARIO ESCRITORIO -->
  <section class="container-fluid header_img formulario_escritorio">
    <div class="container">

      <div class="row">

        <div class="col-lg-7 col-sm-12 wow fadeIn datos_linea align_alto">
          <div class="llamadores">
            <img class="img-fluid" src="img/garantia-blanco.png" alt="garantia 25 años deck ecologicos">
            <img class="img-fluid" src="img/eeuu.png" alt="origen estados unidos">
            <img class="img-fluid" src="img/clips-regalo.png" alt="clips de regalo para decks ecologicos">
          </div>
          <div>
            <h1 class="wow fadeInLeft">LÍNEA <br><strong>DECKS ECOLÓGICOS </strong></h1>
            <img class="img-fluid mb_15 wow fadeIn" src="img/trex.png" alt="deck trex">
          </div>
        </div>

        <div class="col-lg-5 col-sm-12 text-center align_vertical_horizontal">

          <form id="formulario" class="formulario wow fadeIn text-left" method="post">
            <h2 class="h2_formulario">¿Necesitas cotizar un deck ecológico?</h2>
            <h3 class="h3_formulario">Envianos tú consulta hoy mismo!</h3>

            <input name="rubro" type="hidden" value="Deck Ecologico">
            <input name="origin" type="hidden" value="Landing Deck Ecologicos">
            <input name="path" type="hidden" value="deck">

            <div class="form-group">
              <input required name="name" type="text" class="form-control" placeholder="Ingresá tu nombre"
                value="<?= $name ?>">
            </div>

            <div class="form-group">
              <input required name="email" type="email" class="form-control" placeholder="Ingresá tu email"
                value="<?= $email ?>">
            </div>

            <div class="form-group">
              <input required name="phone" type="tel" class="form-control" placeholder="Ingresá tu teléfono"
                value="<?= $phone ?>">
            </div>

            <textarea required class="form-control" name="comments" rows="4"
              placeholder="Que necesitás?"><?= $comments ?></textarea>

            <div class="form-group form-check">
              <input checked name="newsletter" type="checkbox" class="form-check-input" value="Si" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Suscribir newsletter</label>
            </div>

            <!-- reCAPTCHA  -->
            <div id="recaptcha" class="g-recaptcha" data-sitekey="<?= $_ENV['RECAPTCHA_SITE_KEY'] ?>"></div>

            <div class="text-center">
              <input id="send" name="send" type="submit" value="ENVIAR" class="btn btn-primary transition">
            </div>

            <div class="error">
              <ul>
                <?php foreach ($errors as $error) { ?>
                <li><?php echo $error; ?></li>
                <?php } ?>
              </ul>
            </div>

          </form>

        </div>
      </div>

    </div>
  </section>
  <!-- FORMULARIO ESCRITORIO end-->

  <!-- LIBRE DE MANTENIMIENTO -->
  <section class="h2_oferta container-fluid mb_60">
    <div class="container h-100">
      <div class="row">
        <div class="col-md-12 h-100 text-center">
          <h2 class="m-0">¡DECKS LIBRES DE MANTENIMIENTO!</h2>
        </div>
      </div>
    </div>
  </section>
  <!-- LIBRE DE MANTENIMIENTO end -->

  <!-- PAGOS -->
  <section class="container pagos">
    <div class="row">
      <div class="col-md-12">
        <div class="mano_tarjeta">
          <img class="img-fluid" src="img/tarjeta-credito-mano.png" alt="mano tarjeta de credito">
          <h3>PAGÁ EN CUOTAS <br><span class="bold">CON TARJETA DE CRÉDITO</span></h3>
        </div>
        <div class="text-center promos">
          <img class="wow fadeIn img-fluid" src="img/promos.gif" alt="tarjetas promos">
        </div>
      </div>
    </div>
  </section>
  <!-- PAGOS end -->

  <!-- SHOWROOMS NOVEDAD -->
  <section class="h2_oferta showrooms_titulo container-fluid">
    <div class="container h-100">
      <div class="row">
        <div class="col-md-12 h-100 text-center">
          <h2 class="m-0">VISTANOS EN NUESTROS SHOWROOMS</h2>
        </div>
      </div>
    </div>
  </section>
  <!-- SHOWROOMS NOVEDAD end -->

  <!-- MAPAS SHOWROOMS -->
  <section class="container-fluid showrooms">

    <div class="row">
      <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 text-center">
        <h2 class="h2_showrooms wow fadeInLeft">AHORA YA PODES VISITARNOS EN NUESTROS SHOWROOMS DE NORDELTA Y SAN MARTIN
        </h2>
      </div>
    </div>

    <div class="row">

      <div class="col-lg-6 wow fadeInUp nordelta">
        <div class="mapa">
          <iframe style="height:100%; min-height: 435px;"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3291.660118577659!2d-58.63150888436345!3d-34.4099838805101!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bccac8632d0a23%3A0x3711744313aae8a4!2sUrban%20Storage%20Nordelta%20-%20Bauleras%20y%20guardamuebles!5e0!3m2!1ses-419!2sar!4v1571685748990!5m2!1ses-419!2sar"
            width="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </div>
        <div class="datos_mapa">
          <img class="img-fluid" src="img/icon-localization.png" alt="google maps en nordelta">
          <h4>VISITANOS EN<br>NORDELTA</h4>
          <div class="direccion">
            <strong>Urban Storage - Showroom D42 - Av. del Golf 2430</strong><br>
            Nordelta - Buenos Aires - Argentina
          </div>
          <hr>
          <div class="horario">
            <p class="transition" id="cita_previa" style="margin: 0;"><strong>ATENCIÓN:</strong><br>
              Únicamente con cita previa.</p>
          </div>

          <a href="#formulario" class="transition btn boton_showroom">SOLICITAR VISITA.</a>
        </div>
      </div>

      <div class="col-lg-6 wow fadeInUp">
        <div class="mapa">
          <iframe style="height:100%; min-height: 435px;"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3284.9059995397247!2d-58.548108184359705!3d-34.58124498046546!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcb779a0e3d0ff%3A0x46d82ea5a09636a3!2sCalle%2056%204575%2C%20B1650%20Villa%20Lynch%2C%20Buenos%20Aires!5e0!3m2!1ses-419!2sar!4v1571682044210!5m2!1ses-419!2sar"
            width="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </div>
        <div class="datos_mapa">
          <img class="img-fluid" src="img/icon-localization.png" alt="google maps en nordelta">
          <h4>VISITANOS EN<br>SAN MARTÍN</h4>
          <div class="direccion">
            <strong>Calle 56 N°4575 - San Martín - (CP 1560)</strong><br>
            Buenos Aires - Argentina
          </div>
          <hr>
          <div class="horario">
            <strong>ATENCIÓN:</strong><br>
            Lunes a Viernes de 9 a 17 hs.
          </div>

          <a href="#formulario" class="transition btn boton_showroom">CONSULTAR</a>
        </div>
      </div>

    </div>

  </section>
  <!-- MAPAS SHOWROOMS end -->

  <!-- CARACTERISTICAS -->
  <section class="container caracteristicas mb_60">

    <div class="row mb_30">
      <div class="col-md-12 text-center">
        <h2 class="h2_titulos wow fadeInLeft">Deck Ecológico - Descubrí sus características principales</h2>
      </div>
    </div>

    <div class="row">

      <div class="col-lg-6 mb_30 align_vertical wow fadeInUp">
        <img class="tilde" src="img/tilde.png" alt="tilde">
        <h3 class="h3_titulos">Libre de Mantenimiento</h3>
      </div>

      <div class="col-lg-6 mb_30 align_vertical wow fadeInUp">
        <img class="tilde" src="img/tilde.png" alt="tilde">
        <h3 class="h3_titulos">Superior a la Madera</h3>
      </div>

      <div class="col-lg-6 mb_30 align_vertical wow fadeInUp">
        <img class="tilde" src="img/tilde.png" alt="tilde">
        <h3 class="h3_titulos">Resistente a la decoloración y las manchas </h3>
      </div>

      <div class="col-lg-6 mb_30 align_vertical wow fadeInUp">
        <img class="tilde" src="img/tilde.png" alt="tilde">
        <h3 class="h3_titulos">No se pudre, no se deforma, ni se astilla</h3>
      </div>

    </div>

  </section>
  <!-- CARACTERISTICAS end -->

  <!-- FRANJA VERDE -->
  <section class="container-fluid franja_verde mb_60">
    <div class="container">
      <div class="row">

        <div class="col-md-4 wow fadeInLeft align_vertical_horizontal">
          <img src="img/ecologico.png" alt="ecologico deck">
        </div>

        <div class="col-md-8 align_vertical_horizontal">
          <p class="parrafo_franja_verde wow fadeInUp">
            Los Decks Ecológicos o Decks Sintéticos están fabricados con un 95% de materiales reciclados, desde aserrín
            hasta envases plásticos.
          </p>
        </div>

      </div>
    </div>
  </section>
  <!-- FRANJA VERDE end -->

  <!-- TRASCEND -->
  <section class="container mb_30">
    <div class="row">

      <div class="col-md-8 offset-md-2 text-center">
        <h3 class="titulo_linea wow fadeInLeft">DECK ECOLÓGICO - LÍNEA PREMIUM <br><span
            class="destacado">TRASCEND</span></h3>
        <p class="parrafo_descripcion_linea wow fadeIn">
          Los Decks Sintéticos ofrecen un diseño de vanguardia superior al de otros materiales compuestos, en colores
          exclusivos y con <strong>profundos vetados propios de la madera.</strong>
        </p>
        <p class="parrafo_descripcion_linea wow fadeIn">
          Debido a sus propiedades estos son Decks Libre de Mantenimiento.
        </p>
      </div>

    </div>
  </section>
  <!-- TRASCEND end -->

  <!-- COLORES TRASCEND -->
  <section class="container colores mb_60">

    <div class="row">
      <div class="col-md-6 text-center">
        <img class="img-fluid wow fadeInUp" src="img/castano.jpg" align="deck color castaño">
        <h4>Deck Ecológico<br>Color Castaño</h4>
      </div>
      <div class="col-md-6 text-center">
        <img class="img-fluid wow fadeInUp" src="img/gris-nevado.jpg" align="deck color Gris Nevado">
        <h4>Deck Ecológico<br>Color Gris Nevado</h4>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 text-center">
        <img class="img-fluid wow fadeInUp" src="img/lapacho.jpg" align="deck color Lapacho">
        <h4>Deck Ecológico<br>Color Lapacho</h4>
      </div>
      <div class="col-md-6 text-center">
        <img class="img-fluid wow fadeInUp" src="img/roble-montana.jpg" align="deck color Roble Montaña">
        <h4>Deck Ecológico<br>Color Roble Montaña</h4>
      </div>
    </div>

  </section>
  <!-- COLORES TRASCEND end -->

  <div class="divisor mb_60"></div>

  <!-- CONTOUR -->
  <section class="container mb_60">
    <div class="row">

      <div class="col-md-8 offset-md-2 text-center">
        <h3 class="titulo_linea wow fadeInLeft">DECK ECOLÓGICO - LÍNEA ESTÁNDAR <br><span
            class="destacado">CONTOUR</span></h3>
        <p class="parrafo_descripcion_linea wow fadeIn">
          Mantiene las mismas cualidades que la línea Trascend, con el mismo tipo de composición
          y texturas similares, cuyo diferencial está dado por menor masa en su composición estructural.
        </p>
      </div>

    </div>
  </section>
  <!-- CONTOUR end -->

  <!-- COLORES CONTOUR -->
  <section class="container colores mb_60">

    <div class="row">
      <div class="col-md-6 text-center">
        <img class="img-fluid wow fadeInUp" src="img/gris-castor.jpg" align="deck color gris castor">
        <h4>Deck Ecológico<br>Color Gris Castor</h4>
      </div>
      <div class="col-md-6 text-center">
        <img class="img-fluid wow fadeInUp" src="img/rojo-marroqui.jpg" align="deck color Rojo Marroqui">
        <h4>Deck Ecológico<br>Color Rojo Marroqui</h4>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 text-center">
        <img class="img-fluid wow fadeInUp" src="img/arena.jpg" align="deck color Arena">
        <h4>Deck Ecológico<br>Color Arena</h4>
      </div>
      <div class="col-md-6 text-center">
        <img class="img-fluid wow fadeInUp" src="img/marron-torino.jpg" align="deck color Marrón Torino">
        <h4>Deck Ecológico<br>Color Marrón Torino</h4>
      </div>
    </div>

  </section>
  <!-- COLORES CONTOUR end -->



  <!-- FIJACION OCULTA -->
  <section class="container fijacion_oculta mb_60">
    <div class="row align_vertical_horizontal">

      <div class="col-md-5">
        <img class="img-fluid wow fadeInLeft" src="img/fijacion-oculta.jpg" alt="decks fijacion oculta">
      </div>

      <div class="col-md-7 wow fadeInUp">
        <h3>SISTEMA DE FIJACIÓN OCULTA</h3>
        <p class="parrafo_descripcion_linea">
          El sistema de Fijación Oculta consiste en una serie de tablas con
          borde acanalado para un espaciado perfectamente uniforme y sin
          tornillos visibles en la parte superior.
        </p>
      </div>

    </div>
  </section>
  <!-- FIJACION OCULTA end -->

  <!-- FAJA VERDE -->
  <section class="container-fluid faja_verde">
    <div class="container">
      <div class="row text-center">

        <div class="col-md-8 offset-md-2 wow fadeIn">
          <p>
            <strong>BELLEZA INCOMPARABLE</strong><br>
            Deck de alto tránsito con acabado de vetas de aspecto natural,
            los Decks Trex pueden convertir un espacio al aire libre en su lugar preferido.
          </p>
        </div>

      </div>
    </div>
  </section>
  <!-- FAJA VERDE end -->

  <!-- GARANTIA 25 AÑOS -->
  <section class="container garantia text-center">
    <div class="row align_vertical_horizontal">

      <div class="col-md-3">
        <img class="img-fluid wow fadeInLeft" src="img/garantia-25-anos.gif" alt="garantia de 25 años decks">
      </div>

      <div class="col-md-5 offset-md-1 wow fadeInUp text-left">
        <p class="parrafo_descripcion_linea">
          Como líderes de exteriores, es simplemente natural
          que ofrezcamos garantías que duran décadas y
          <strong>superan la duración de todas las demás.</strong>
        </p>
      </div>

    </div>
  </section>
  <!-- GARANTIA 25 AÑOS end -->

  <!-- IMAGEN FOOTER -->
  <section class="container-fluid imagen_footer mb_60">
    <div class="container">
      <div class="row">

        <div class="col-lg-10 offset-lg-2 col-md-12">
          <h3 class="wow fadeInUp">Mejor rendimiento. <span>Mayor duración.</span></h3>
        </div>

      </div>
    </div>
  </section>
  <!-- IMAGEN FOOTER end -->

  <!-- APLICACIONES RECOMENDADAS -->
  <section class="container aplicaciones">
    <div class="row mb_30">

      <div class="col-md-12 text-center">
        <h5 class="bold wow fadeInLeft">DECK ECOLÓGICOS - APLICACIONES RECOMENDADAS</h5>
        <p class="parrafo_descripcion_linea wow fadeInUp">
          - Deck Para Piletas. <br>
          - Deck Para Espacios Exteriores. <br>
          - Deck Para terrazas. <br>
          - Revestimiento de Fachadas entre otros muchos usos.
        </p>
      </div>

    </div>

    <div class="row">

      <div class="col-md-4 text-center">
        <img class="mb_15 wow fadeInUp" src="img/lavado.gif" alt="deck facil lavado">
        <p class="aplicaciones_parrafo">Lavado con agua y jabón o lavadora de presión.</p>
      </div>

      <div class="col-md-4 text-center">
        <img class="mb_15 wow fadeInUp" src="img/resistente.gif" alt="deck resistente a rayones e impactos">
        <p class="aplicaciones_parrafo">Resiste a los efectos del desgaste de la naturaleza.</p>
      </div>

      <div class="col-md-4 text-center">
        <img class="mb_15 wow fadeInUp" src="img/acabado.gif" alt="deck acabado de vetas naturales">
        <p class="aplicaciones_parrafo">Acabado de vetas de madera de aspecto natural.</p>
      </div>

    </div>
  </section>
  <!-- APLICACIONES RECOMENDADAS end -->

  <footer class="container-fluid">
    <div class="container text-center">
      <div class="row mb_15">
        <div class="col-md-8 offset-md-2 align_vertical_horizontal">
          <div class="transition mail">
            <a href="#formulario" class="boton_showroom"><img src="img/mail.png" alt="mail">info@nordeco.com.ar</a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <p>Copyright &copy; <?= date('Y'); ?>, All Rights Reserved.</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Optional JavaScript -->
  <!-- jQuery primero, luego Popper.js, luego Bootstrap JS -->
  <script type="text/javascript" src="./../js/jquery.min.js"></script>
  <script type="text/javascript" src="./../js/popper.min.js"></script>
  <script type="text/javascript" src="./../js/bootstrap.min.js"></script>

  <!-- Jquery easing -->
  <script type="text/javascript" src="./../js/jquery.easing.1.3.min.js"></script>

  <!-- Wow efecto para que aparezcan los objetos cuando se va scroleando -->
  <script type="text/javascript" src="./../js/wow.min.js"></script>

  <!-- Comunes a todos las paginas -->
  <script type="text/javascript" src="js/app.js"></script>
</body>

</html>