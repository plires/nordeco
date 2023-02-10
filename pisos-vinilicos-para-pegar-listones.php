<?php include_once('includes/conexion.php'); ?>

<!DOCTYPE html>
<!--[if IE 9]> <html lang="es" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="es">
	<!--<![endif]-->

	<head>
		<!-- Tag Manager Head-->
		<?php include_once("includes/tag_manager_head.php") ?>
		<meta charset="utf-8">
		<title>Nordeco, pisos vinilicos sistema para pegar - Listones</title>
		<meta name="description" content="Pisos vinilicos flotantes con sistema de pegar. Listones">
		<meta name="author" content="Libre">

		<!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Favicon -->
		<link rel="shortcut icon" href="images/favicon.ico">

		<!-- Equipo -->
    	<link type="text/plain" rel="author" href="humans.txt" />

		<!-- Web Fonts -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Raleway:700,400,300' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>

		<!-- Bootstrap core CSS -->
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">

		<!-- Font Awesome CSS -->
		<link href="fonts/font-awesome/css/font-awesome.css" rel="stylesheet">

		<!-- Fontello CSS -->
		<link href="fonts/fontello/css/fontello.css" rel="stylesheet">

		<!-- Plugins -->
		<link href="plugins/magnific-popup/magnific-popup.css" rel="stylesheet">
		<link href="plugins/rs-plugin-5/css/settings.css" rel="stylesheet">
		<link href="plugins/rs-plugin-5/css/navigation.css" rel="stylesheet">
		<link href="css/animations.css" rel="stylesheet">
		<link href="plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
		<link href="plugins/owl-carousel/owl.transitions.css" rel="stylesheet">
		<link href="plugins/hover/hover-min.css" rel="stylesheet">
		<!-- Plugin Slick (Carrousel logos) CSS -->
    <link rel="stylesheet" type="text/css" href="plugins/slick.css">
    <link rel="stylesheet" type="text/css" href="plugins/slick-theme.css">
		
		<!-- The Project core CSS file -->
		<link href="css/style.css" rel="stylesheet" >
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
	<body class="no-trans front-page   ">
		<!-- Tag Manager -->
		<?php include_once("includes/tag_manager_body.php") ?>

		<?php $product="pisos"; ?>
		<?php $currentCat="pisos-pegar"; ?>
		<?php $currentSub="pegar-liston"; ?>

		<!-- scrollToTop -->
		<!-- ================ -->
		<div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>
		
		<!-- page wrapper start -->
		<!-- ================ -->

		<div class="page-wrapper">
			<?php include ("includes/header.inc"); ?>
			<div id="page-start"></div>

			<?php include ("includes/slide-pisos-vinilicos-pegar.inc"); ?>

			<section class="container">
				<div class="col-sm-12 text-center">
					<br>
					<h1>PISOS VINÍLICOS</h1>
					<h2 class="light">SISTEMA PARA PEGAR - LISTONES</h2>
				</div>
			</section>

			<!-- section gris start -->
			<section class="section fondo_oscuro pv-40 clearfix text-center tipo_1_5em">
				<div class="container">
					<div class="col-sm-12">
						<h3 class="color_blanco light">Ahora es posible instalar hermosos pisos en áreas de alto tránsito , como cocinas, baños, locales comerciales y oficinas. Pisos a prueba de agua, Sistema para pegar</h3>
					</div>
				</div>
			</section>
			<!-- section gris end -->


			<!-- section gris start -->
			<section class="container">
				<div class="col-sm-12 text-center margin-top-30">
					<p class="tipo_1_2em">
						Son pisos que están compuestos por material 100% de PVC y se utilizan en la instalación de suelos con un alto rendimiento. Estos pisos vinílicos tienen una gran resistencia al desgaste y son libres de mantenimiento, poseen el valor agregado de una instalación muy sencilla, a través del sistema de pegado. Están compuestos por: * Una capa superficial que se llama Wear Layer (capa de uso), que puede ser de 0,2mm ó de 0,3mm y es de alto tránsito residencial. Esta capa le otorga resistencia a altas exigencias en el tránsito, lo que evita su desgaste y facilita su limpieza. * Un diseño decorativo * Y finalmente la estructura del piso que es de PVC 100%. 
					</p>
				</div>
			</section>
			<!-- section gris end -->

			<!-- Imagenes listones start -->
			<div class="container">
				<section class="row">
					<div class="col-sm-12">
						<h2>PISOS VINÍLICOS SISTEMA PARA PEGAR - LISTONES</h2>
						<div class="separator-2"></div>
					</div>

					<?php 
						$query = $db->prepare("SELECT * FROM pisos WHERE observaciones = 'Sistema para Pegar' AND linea = 'listones'");
						$query->execute();
						$results = $query->fetchAll(PDO::FETCH_ASSOC);

						foreach ($results as $result) { ?>

							<article class="col-xs-12 col-sm-6 col-md-4 col-lg-3 padding_10px text-center listado">
									<img class="centrar_imagen" src="<?= $result['ruta'] .'/'. $result['nombre'] ?>" alt="<?= $result['alt'] ?>">
								<h3><?= $result['titulo'] ?></h3>
								<h4><?= $result['descripcion'] ?></h4>
								<p class="atributos">Medidas: <?= $result['medidas'] ?></p>
								<p class="atributos">Espesor: <?= $result['espesor'] ?></p>
								<p class="atributos">Línea: <?= $result['linea'] ?></p>
							</article>

						<?php
						}
					?>

				</section>
			</div>
			<!-- Imagenes listones end -->

			<!-- Mas info Verde -->
			<?php include('includes/mas-info-verde.inc'); ?>
			<!-- Mas info Verde end -->

			<!-- Mas info aspectos y ventajas -->
			<?php include('includes/pisos-aspectos.inc'); ?>
			<!-- Mas info aspectos y ventajas end -->

			<!-- section gris start -->
			<section class="section fondo_gris pv-40 clearfix text-center tipo_1_5em">
				<div class="container">
					<div class="col-sm-12">
						<h3 class="light">
							Diferentes diseños han sido recreados con extremo control de calidad <br>
							<span class="bold">para asegurar texturas naturales de madera reales.</span></h3>
					</div>
				</div>
			</section>
			<!-- section gris end -->

			<!-- Galeria de imagenes -->
			<?php include_once("includes/galeria-imagenes-pisos.inc") ?>
			<!-- Galeria de imagenes end -->
			
			<br>&nbsp;

			<!-- Footer -->
			<?php include_once("includes/footer.inc") ?>
			<!-- Footer end -->

		</div>
		<!-- page-wrapper end -->

		<!-- JavaScript files placed at the end of the document so the pages load faster -->
		<!-- ================================================== -->
		<!-- Jquery and Bootstap core js files -->
		<script type="text/javascript" src="plugins/jquery.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
		<!-- Modernizr javascript -->
		<script type="text/javascript" src="plugins/modernizr.js"></script>
		<script type="text/javascript" src="plugins/rs-plugin-5/js/jquery.themepunch.tools.min.js?rev=5.0"></script>
		<script type="text/javascript" src="plugins/rs-plugin-5/js/jquery.themepunch.revolution.min.js?rev=5.0"></script>
		<!-- Isotope javascript -->
		<script type="text/javascript" src="plugins/isotope/isotope.pkgd.min.js"></script>
		<!-- Magnific Popup javascript -->
		<script type="text/javascript" src="plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
		<!-- Appear javascript -->
		<script type="text/javascript" src="plugins/waypoints/jquery.waypoints.min.js"></script>
		<!-- Count To javascript -->
		<script type="text/javascript" src="plugins/jquery.countTo.js"></script>
		<!-- Parallax javascript -->
		<script src="plugins/jquery.parallax-1.1.3.js"></script>
		<!-- Owl carousel javascript -->
		<script type="text/javascript" src="plugins/owl-carousel/owl.carousel.js"></script>
		<!-- SmoothScroll javascript -->
		<script type="text/javascript" src="plugins/jquery.browser.js"></script>
		<script type="text/javascript" src="plugins/SmoothScroll.js"></script>
		<!-- Initialization of Plugins -->
		<script type="text/javascript" src="js/template.js"></script>
		<!-- Custom Scripts -->
		<script type="text/javascript" src="js/custom.js"></script>

		<!-- Plugin Slick (Carrousel) JS -->
    <script src="plugins/slick.min.js" type="text/javascript" charset="utf-8"></script>
    
		<!-- Mailchimp -->
		<script type="text/javascript" src="//downloads.mailchimp.com/js/signup-forms/popup/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script><script type="text/javascript">require(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us17.list-manage.com","uuid":"406cbe29a3e2f9eb2369a881b","lid":"3c63e69616"}) })</script>

	</body>
</html>
