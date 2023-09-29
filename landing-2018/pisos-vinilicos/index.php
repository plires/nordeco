<!-- formulario -->
<?php

	require_once( __DIR__ . '/../vendor/autoload.php' );
	include_once( __DIR__ . '/../clases/app.php' );
	
	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
	$dotenv->safeLoad();
	define('PERFIT_INTEREST', 3);

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
			$send = $app->sendEmail($_POST, 'cliente', 'Presupuesto Pisos Vinílicos');
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
  <meta name="description" content="pisos vinilicos flotantes con sistema de encastre tipo click sin adhesivos.">

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

  <title>Pisos Vinilicos - Sistema click sin adhesivo</title>

</head>

<body>
  <!-- Tag Manager Body -->
  <?php include_once("../includes/tag_manager_body.inc") ?>

  <!-- HEADER -->
  <header class="container">
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
      <div class="col-md-12"><img class="img-fluid wow fadeInLeft" src="img/pisos-header-mobile.jpg">
        <h1 class="wow fadeIn mb_15">LÍNEA <br><strong>PISOS FLOTANTES</strong></h1>
        <div class="content_logo_pisoplast">
          <img class="logo_pisoplast wow fadeIn" src="img/pisoplast-mobile.gif" alt="pisoplast mobile">
        </div>

        <div class="mb_30">
          <h3 class="h3_paga_cuotas wow fadeInUp mb_30">PAGÁ EN CUOTAS CON TARJETA DE CRÉDITO</h3>
          <div class="text-center">
            <img class="img-fluid wow fadeInLeft mb_30" src="img/tarjetas.png" alt="tarjetas">
            <p class="parrafo_descripcion_linea wow fadeInUp">CONSULTANOS LA MEJOR FINANCIACIÓN</p>
          </div>
        </div>

        <form class="formulario text-left wow fadeIn" method="post">
          <h2 class="h2_formulario">¿Necesitas cotizar un producto?</h2>
          <h3 class="h3_formulario">Envianos tú consulta hoy mismo!</h3>

          <input name="rubro" type="hidden" value="Piso Vinilico">
          <input name="origin" type="hidden" value="Landing Pisos Vinilicos">
          <input name="path" type="hidden" value="pisos-vinilicos">

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

          <textarea required class="form-control" name="comments" rows="3"
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

        <div class="col-lg-7 col-sm-12 wow fadeIn datos_linea">
          <div class="text-left">
            <img class="header_garantia wow fadeInUp" src="img/sistema-click.png" alt="sistema click">
          </div>
          <h1>LÍNEA <br><strong>PISOS VINÍLICOS</strong></h1>
          <img class="mb_15" src="img/pisoplast.png" alt="pisos vinilicos pisoplast">
          <div class="medios_pago wow fadeInLeft">
            <h3>PAGÁ EN CUOTAS <br><span class="bold">CON TARJETA DE CRÉDITO</span></h3>
            <div class="text-center">
              <img class="wow fadeIn" src="img/tarjetas.png" alt="tarjetas">
              <p>CONSULTANOS LA MEJOR FINANCIACIÓN</p>
            </div>
          </div>
        </div>

        <div class="col-lg-5 col-sm-12 text-center align_vertical_horizontal">

          <form id="formulario" class="formulario wow fadeIn text-left" method="post">
            <h2 class="h2_formulario">¿Necesitas cotizar un producto?</h2>
            <h3 class="h3_formulario">Envianos tú consulta hoy mismo!</h3>

            <input name="rubro" type="hidden" value="Piso Vinilico">
            <input name="origin" type="hidden" value="Landing Pisos Vinilicos">
            <input name="path" type="hidden" value="pisos-vinilicos">

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

  <!-- SHOWROOMS NOVEDAD -->
  <section class="h2_oferta h2_pisos showrooms_titulo container-fluid">
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

    <div class="row mb_60">
      <div class="col-md-8 offset-md-2 text-center mb_60">
        <h2 class="h2_encabezado wow fadeInLeft">
          Los Pisos Flotantes Pisoplast, son ideales para entornos
          comerciales y domésticos. <br><strong>Desarrollados con materiales de primera calidad.</strong> Aptos alto
          tránsito.
        </h2>
      </div>
      <div class="col-md-12 text-center">
        <h2 class="h2_titulos wow fadeInLeft">Descubrí sus características principales</h2>
      </div>
    </div>

    <div class="row">

      <div class="col-lg-6 mb_30 align_vertical wow fadeInUp">
        <img class="tilde" src="img/tilde.png" alt="tilde">
        <h3 class="h3_titulos">Resistentes a rayones y golpes</h3>
      </div>

      <div class="col-lg-6 mb_30 align_vertical wow fadeInUp">
        <img class="tilde" src="img/tilde.png" alt="tilde">
        <h3 class="h3_titulos">Resistentes al Agua y Humedad</h3>
      </div>

      <div class="col-lg-6 mb_30 align_vertical wow fadeInUp">
        <img class="tilde" src="img/tilde.png" alt="tilde">
        <h3 class="h3_titulos">Aislamiento acústico y térmico</h3>
      </div>

      <div class="col-lg-6 mb_30 align_vertical wow fadeInUp">
        <img class="tilde" src="img/tilde.png" alt="tilde">
        <h3 class="h3_titulos">Rápida y Fácil instalación</h3>
      </div>

      <div class="col-lg-6 mb_30 align_vertical wow fadeInUp">
        <img class="tilde" src="img/tilde.png" alt="tilde">
        <h3 class="h3_titulos">Texturas simil madera</h3>
      </div>

    </div>

  </section>
  <!-- CARACTERISTICAS end -->

  <!-- FRANJA VERDE -->
  <section class="container-fluid franja_verde">
    <div class="container">
      <div class="row">

        <div class="col-md-10 offset-md-1 text-center align_vertical_horizontal">
          <p class="parrafo_franja_gris wow fadeInUp">
            Diferentes diseños han sido recreados con extremo control
            de calidad para asegurar texturas naturales de madera reales.
          </p>
        </div>

      </div>
    </div>
  </section>
  <!-- FRANJA VERDE end -->

  <!-- LINEA LISTONES -->
  <section class="container-fluid lineas mb_60">
    <div class="container">
      <div class="row">

        <div class="col-md-10 offset-md-1 text-center align_vertical_horizontal">
          <h2 class="titulo_lineas">Pisos Flotantes - Línea Listones</h2>
        </div>

      </div>
    </div>
  </section>
  <!-- LINEA LISTONES end -->

  <!-- COLORES LINEA LISTONES -->
  <section class="container colores mb_60">

    <div class="row mb_60">

      <div class="col-md-6 text-center mb_30">
        <img class="img-fluid wow fadeInUp" src="img/gris-castor.jpg" align="pisos vinilicos color Gris castor">
        <h4>Piso Vínilico - Gris Castor</h4>
        <div class="precios wow fadeIn">
          <!-- <p class="wow fadeInLeft tacha_precio_viejo">$1323</p> -->
          <!-- <p class="wow fadeInLeft precio_promo">$1132 <span class="m2">+ iva x m2</span></p> -->
          <span>Disponible <span class="font-weight-bold">60 Cajas</span><br> (cajas de 2.35 m2)</span>
          <p class="vigencia">* Válido hasta agotar stock</p>
        </div>
        <p class="aplicaciones_parrafo wow fadeInUp">>366 Cm x 14 Cm <br>4 mm espesor</p>
        <a class="btn-primary btn_comprar transition wow fadeIn" href="#formulario">COTIZAR</a>
        <a class="btn-primary transition wow fadeIn btn_comprar_mobile" href="#formulario">COTIZAR</a>
      </div>

      <div class="col-md-6 text-center mb_30">
        <img class="img-fluid wow fadeInUp" src="img/gris-veta.jpg" align="pisos vinilicos color Gris Veta">
        <h4>Piso Vínilico - Gris Veta</h4>
        <div class="precios wow fadeIn">
          <!-- <p class="wow fadeInLeft tacha_precio_viejo">$1323</p> -->
          <!-- <p class="wow fadeInLeft precio_promo">$1132 <span class="m2">+ iva x m2</span></p> -->
          <span>Disponible <span class="font-weight-bold">20 Cajas</span><br> (cajas de 2.35 m2)</span>
          <p class="vigencia">* Válido hasta agotar stock</p>
        </div>
        <p class="aplicaciones_parrafo wow fadeInUp">>366 Cm x 14 Cm <br>4 mm espesor</p>
        <a class="btn-primary btn_comprar transition wow fadeIn" href="#formulario">COTIZAR</a>
        <a class="btn-primary transition wow fadeIn btn_comprar_mobile" href="#formulario">COTIZAR</a>
      </div>

    </div>

    <div class="row mb_60">

      <div class="col-md-6 text-center mb_30">
        <img class="img-fluid wow fadeInUp" src="img/vison-castor.jpg" align="pisos vinilicos color vison castor">
        <h4>Piso Vínilico - Visón Castor</h4>
        <div class="precios wow fadeIn">
          <!-- <p class="wow fadeInLeft tacha_precio_viejo">$1323</p> -->
          <!-- <p class="wow fadeInLeft precio_promo">$1132 <span class="m2">+ iva x m2</span></p> -->
          <span>Disponible <span class="font-weight-bold">50 Cajas</span><br> (cajas de 2.35 m2)</span>
          <p class="vigencia">* Válido hasta agotar stock</p>
        </div>
        <p class="aplicaciones_parrafo wow fadeInUp">>366 Cm x 14 Cm <br>4 mm espesor</p>
        <a class="btn-primary btn_comprar transition wow fadeIn" href="#formulario">COTIZAR</a>
        <a class="btn-primary transition wow fadeIn btn_comprar_mobile" href="#formulario">COTIZAR</a>
      </div>

      <div class="col-md-6 text-center mb_30">
        <img class="img-fluid wow fadeInUp" src="img/roble-americano.jpg" align="pisos vinilicos color Roble Americano">
        <h4>Piso Vínilico - Roble Americano</h4>
        <div class="precios wow fadeIn">
          <!-- <p class="wow fadeInLeft precio_promo">$1132</p> -->
          <!-- <span class="precio_promo">+ iva x m2</span> -->
          <p class="vigencia">* Consultar Stock</p>
        </div>
        <p class="aplicaciones_parrafo wow fadeInUp">>366 Cm x 14 Cm <br>4 mm espesor</p>
        <a class="btn-primary btn_comprar transition wow fadeIn" href="#formulario">COTIZAR</a>
        <a class="btn-primary transition wow fadeIn btn_comprar_mobile" href="#formulario">COTIZAR</a>
      </div>

    </div>

    <div class="row mb_60">

      <div class="col-md-6 text-center mb_30">
        <img class="img-fluid wow fadeInUp" src="img/maple.jpg" align="pisos vinilicos color Maple">
        <h4>Piso Vínilico - Maple</h4>
        <div class="precios wow fadeIn">
          <!-- <p class="wow fadeInLeft precio_promo">$1132</p> -->
          <!-- <span class="precio_promo">+ iva x m2</span> -->
          <p class="vigencia">* Consultar Stock</p>
        </div>
        <p class="aplicaciones_parrafo wow fadeInUp">>366 Cm x 14 Cm <br>4 mm espesor</p>
        <a class="btn-primary btn_comprar transition wow fadeIn" href="#formulario">COTIZAR</a>
        <a class="btn-primary transition wow fadeIn btn_comprar_mobile" href="#formulario">COTIZAR</a>
      </div>

      <div class="col-md-6 text-center mb_30">
        <img class="img-fluid wow fadeInUp" src="img/nogal.jpg" align="pisos vinilicos color Nogal">
        <h4>Piso Vínilico - Nogal</h4>
        <div class="precios wow fadeIn">
          <!-- <p class="wow fadeInLeft tacha_precio_viejo">$1365</p> -->
          <!-- <p class="wow fadeInLeft precio_promo">$1132 <span class="m2">+ iva x m2</span></p> -->
          <span>Disponible <span class="font-weight-bold">100 Cajas</span><br> (cajas de 2.35 m2)</span>
          <p class="vigencia">* Válido hasta agotar stock</p>
        </div>
        <p class="aplicaciones_parrafo wow fadeInUp">>366 Cm x 14 Cm <br>4 mm espesor</p>
        <a class="btn-primary btn_comprar transition wow fadeIn" href="#formulario">COTIZAR</a>
        <a class="btn-primary transition wow fadeIn btn_comprar_mobile" href="#formulario">COTIZAR</a>
      </div>

    </div>

    <div class="row mb_60">

      <div class="col-md-6 text-center mb_30">
        <img class="img-fluid wow fadeInUp" src="img/caoba.jpg" align="pisos vinilicos color vison Caoba">
        <h4>Piso Vínilico - Visón Caoba</h4>
        <div class="precios wow fadeIn">
          <!-- <p class="wow fadeInLeft tacha_precio_viejo">$1323</p> -->
          <!-- <p class="wow fadeInLeft precio_promo">$1132 <span class="m2">+ iva x m2</span></p> -->
          <span>Disponible <span class="font-weight-bold">30 Cajas</span><br> (cajas de 2.35 m2)</span>
          <p class="vigencia">* Válido hasta agotar stock</p>
        </div>
        <p class="aplicaciones_parrafo wow fadeInUp">>366 Cm x 14 Cm <br>4 mm espesor</p>
        <a class="btn-primary btn_comprar transition wow fadeIn" href="#formulario">COTIZAR</a>
        <a class="btn-primary transition wow fadeIn btn_comprar_mobile" href="#formulario">COTIZAR</a>
      </div>

    </div>

    <div class="row">
      <div class="col-md-8 text-center mb_30">
        <img class="img-fluid wow fadeInUp" src="img/medida-liston.jpg" align="piso vinilico medida listones">
      </div>
      <div class="medidas text-center wow fadeInUp col-md-4 mb_30 align_vertical_horizontal">
        <div class="text-center">
          <h4>Piso Alto Tránsito <br> Medidas Listón</h4><br>
          <p>
            Ancho: 175 mm <br>
            Largo: 1200 mm <br>
            Espesor: 4 mm
          </p>
        </div>
      </div>
    </div>

  </section>
  <!-- COLORES LINEA LISTONES end -->

  <!-- LINEA BALDOSAS -->
  <section class="container-fluid lineas mb_60">
    <div class="container">
      <div class="row">

        <div class="col-md-10 offset-md-1 text-center align_vertical_horizontal">
          <h2 class="titulo_lineas">Pisos Flotantes - Línea Baldosas</h2>
        </div>

      </div>
    </div>
  </section>
  <!-- LINEA BALDOSAS end -->

  <!-- COLORES LINEA BALDOSAS -->
  <section class="container colores mb_60">

    <div class="row mb_60">

      <div class="col-md-6 text-center mb_30">
        <img class="img-fluid wow fadeInUp" src="img/marfil.jpg" align="pisos vinilicos color Marfil">
        <h4>Piso Vínilico - Marfil</h4>
        <div class="precios wow fadeIn">
          <!-- <p class="wow fadeInLeft tacha_precio_viejo">$1230</p> -->
          <!-- <p class="wow fadeInLeft precio_promo">$1149 <span class="m2">+ iva x m2</span></p> -->
          <span>Disponible <span class="font-weight-bold">100 Cajas</span><br> (cajas de 2.5 m2)</span>
          <p class="vigencia">* Válido hasta agotar stock</p>
        </div>
        <p class="aplicaciones_parrafo wow fadeInUp">>366 Cm x 14 Cm <br>4 mm espesor</p>
        <a class="btn-primary btn_comprar transition wow fadeIn" href="#formulario">COTIZAR</a>
        <a class="btn-primary transition wow fadeIn btn_comprar_mobile" href="#formulario">COTIZAR</a>
      </div>

      <div class="col-md-6 text-center mb_30">
        <img class="img-fluid wow fadeInUp" src="img/cemento.jpg" align="pisos vinilicos color Cemento">
        <h4>Piso Vínilico - Cemento</h4>
        <div class="precios wow fadeIn">
          <!-- <p class="wow fadeInLeft tacha_precio_viejo">$1230</p> -->
          <!-- <p class="wow fadeInLeft precio_promo">$1149 <span class="m2">+ iva x m2</span></p> -->
          <span>Disponible <span class="font-weight-bold">20 Cajas</span><br> (cajas de 2.5 m2)</span>
          <p class="vigencia">* Válido hasta agotar stock</p>
        </div>
        <p class="aplicaciones_parrafo wow fadeInUp">>366 Cm x 14 Cm <br>4 mm espesor</p>
        <a class="btn-primary btn_comprar transition wow fadeIn" href="#formulario">COTIZAR</a>
        <a class="btn-primary transition wow fadeIn btn_comprar_mobile" href="#formulario">COTIZAR</a>
      </div>

      <div class="col-md-8 text-center mb_30">
        <img class="img-fluid wow fadeInUp" src="img/medida-baldosa.jpg" align="piso vinilico medida baldosas">
      </div>

      <div class="medidas text-center wow fadeInUp col-md-4 mb_30 align_vertical_horizontal">
        <div class="text-center">
          <h4>Piso Alto Tránsito<br>Medidas Listón</h4><br>
          <p>
            Ancho: 300 mm <br>
            Largo: 600 mm <br>
            Espesor: 4 mm
          </p>
        </div>
      </div>

    </div>

  </section>
  <!-- COLORES LINEA BALDOSAS end -->

  <!-- TECNOLOGIA CLICK -->
  <section class="container colores mb_60">

    <div class="row">
      <div class="col-md-6 text-center mb_30">
        <img class="img-fluid wow fadeInUp" src="img/encastre-click.jpg" align="piso vinilico medida baldosas">
      </div>
      <div class="col-md-6 mb_30 wow fadeInLeft align_vertical_horizontal">
        <div>
          <h4>PISOS VINÍLICOS CON TECNOLOGÍA DE ENCASTRE CLICK</h4>
          <p>
            El sistema de encastre Click permite una colocación
            prolija, rápida e higiénica. Las tablas se encastran
            unas con otras de una manera sencilla y veloz,
            permitiendo un acabado prolijo e inigualable, sin
            necesidad de encolar las tablas entre sí, ni utilizar
            clavos, tornillos u otros elementos de fijación,
            logrando que sea más estético.
          </p>
        </div>
      </div>
    </div>

  </section>
  <!-- TECNOLOGIA CLICK end -->

  <!-- FRANJA VERDE -->
  <section class="container-fluid franja_verde mb_60">
    <div class="container">
      <div class="row">

        <div class="col-md-10 offset-md-1 text-center align_vertical_horizontal">
          <p class="parrafo_franja_gris wow fadeInUp">
            TEXTURAS INNOVADORAS. AMBIENTES SOFISTICADOS. <br>
            <strong>PERFECCIÓN A LA VISTA, SUAVIDAD AL TACTO</strong>
          </p>
        </div>

      </div>
    </div>
  </section>
  <!-- FRANJA VERDE end -->

  <!-- FACIL INSTALACION -->
  <section class="container instalacion wow fadeInUp mb_60">
    <div class="row">

      <div class="col-md-12 wow fadeInUp align_vertical">
        <img src="img/tilde.png">
        <h2><strong>Fácil y Rápida <br>Colocación</strong></h2>
      </div>
      <div class="col-md-12 wow fadeInLeft align_vertical">
        <p>
          Gracias al exclusivo sistema click,
          su colocación puede realizarse
          sin personal especializado.
        </p>
      </div>
      <div class="col-md-12 wow fadeInUp align_vertical">
        <span>
          PISOS VINÍLICOS SIN ADHESIVOS.
        </span>
      </div>

    </div>
  </section>
  <!-- FACIL INSTALACION end -->

  <div class="divisor mb_60"></div>





  <!-- APLICACIONES RECOMENDADAS -->
  <section class="container aplicaciones mb_60">

    <div class="row mb_30">
      <div class="col-md-12 text-center">
        <h4 class="bold wow fadeInLeft">Características Principales</h4>
      </div>
    </div>

    <div class="row">

      <div class="col-md-3 text-center">
        <img class="mb_15 wow fadeInUp" src="img/facil-instalar.gif" alt="pisos vinilicos facil lavado">
        <p class="aplicaciones_parrafo">Fácil de instalar, limpiar y mantener.</p>
      </div>

      <div class="col-md-3 text-center">
        <img class="mb_15 wow fadeInUp" src="img/resistente-aranazos.gif"
          alt="pisos vinilicos resistentes a los arañazos">
        <p class="aplicaciones_parrafo">Resistente a golpes y arañazos.</p>
      </div>

      <div class="col-md-3 text-center">
        <img class="mb_15 wow fadeInUp" src="img/sin-quimicos.gif" alt="pisos vinilicos no requiere productos quimicos">
        <p class="aplicaciones_parrafo">No requiere de productos químicos agresivos para su limpieza.</p>
      </div>

      <div class="col-md-3 text-center">
        <img class="mb_15 wow fadeInUp" src="img/superficies-existentes.gif"
          alt="pisos vinilicos sobre superficies existentes">
        <p class="aplicaciones_parrafo">Se aplica en Pisos Existentes</p>
      </div>

    </div>

    <div class="row">

      <div class="col-md-3 text-center">
        <img class="mb_15 wow fadeInUp" src="img/resistente-agua.gif" alt="pisos vinilicos resistentes al agua">
        <p class="aplicaciones_parrafo">Resistente 100% al agua, ideal en baños y cocinas.</p>
      </div>

      <div class="col-md-3 text-center">
        <img class="mb_15 wow fadeInUp" src="img/materiales-reciclados.gif" alt="pisos vinilicos materiales reciclados">
        <p class="aplicaciones_parrafo">Fabricado con materiales reciclados.</p>
      </div>

      <div class="col-md-3 text-center">
        <img class="mb_15 wow fadeInUp" src="img/aislamiento-acustico.gif" alt="pisos vinilicos aislamiento acustico">
        <p class="aplicaciones_parrafo">Aislamiento acústico y térmico, ideal para pisos radiantes.</p>
      </div>

      <div class="col-md-3 text-center">
        <img class="mb_15 wow fadeInUp" src="img/antideslizante.gif" alt="pisos vinilicos antideslizantes">
        <p class="aplicaciones_parrafo">Antideslizante.</p>
      </div>

    </div>
  </section>
  <!-- APLICACIONES RECOMENDADAS end -->

  <footer class="container-fluid">
    <div class="container text-center">
      <div class="row mb_15">
        <div class="col-md-8 offset-md-2 align_vertical_horizontal">
          <div class="transition mail">

            <a href="#formulario"><img src="img/mail.png" alt="mail">info@nordeco.com.ar</a>
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