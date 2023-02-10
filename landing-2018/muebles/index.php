<!-- formulario -->
<?php


include_once( __DIR__ . '/../includes/config.inc.php' );
include_once( __DIR__ . '/../clases/app.php' );
define('PERFIT_INTEREST', 14);

$errors=array();
$name="";
$email="";
$phone="";
$comments="";
$rubro="";
$origin="";

/*Si el post viene por el formulario de contacto*/
if (isset($_POST['send'])){
	include ('includes/funciones_validar.php');

	//Comprobamos el reCaptcha
	include_once("includes/recaptcha.php");

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
    $app->registerEmailContactsInPerfit(PERFIT_APY_KEY, PERFIT_LIST, $_POST, RECIPIENT);
    
		include_once("php/envio.php");
	}

}

?>

<!doctype html>
<html lang="es">
	<head>
		<!-- Tag Manager Head -->
    <?php include_once("includes/tag_manager_head.inc") ?>

	  <!-- Required meta tags -->
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="description" content="Muebles para exteriores e interperies.">

	  <!-- Favicons -->
    <link rel="apple-touch-icon" href="img/apple-icon.png">
    <link rel="icon" href="img/favicon.png">

    <!-- Normalize CSS -->
	  <link rel="stylesheet" type="text/css" href="css/normalize.min.css">

	  <!-- Bootstrap CSS -->
	  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

	  <!-- Animated CSS -->
	  <link rel="stylesheet" type="text/css" href="css/animate.css">

	  <!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

		<!-- Plugin Slick (Carrousel logos) CSS -->
    <link rel="stylesheet" type="text/css" href="plugins/slick.css">
    <link rel="stylesheet" type="text/css" href="plugins/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="plugins/magnific-popup/magnific-popup.css">

	  <!-- Custom CSS -->
	  <link rel="stylesheet" type="text/css" href="css/app.css">

	  <!-- recaptcha -->
		<script src='https://www.google.com/recaptcha/api.js'></script>

	  <title>Muebles de Exteriores</title>
		
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
	
	<body>
		<!-- Tag Manager Body -->
		<?php include_once("includes/tag_manager_body.inc") ?>

		<!-- HEADER -->
		<header class="container">
			<div class="row">

				<div class="col-md-6 wow fadeIn">
		      <img src="img/logo-nordeco.png" alt="logo nordeco">
				</div>

				<div class="col-md-6 wow fadeIn header_datos hidden_phone">
		      <a class="transition email" href="mailto:info@nordeco.com.ar">info@nordeco.com.ar</a>

		      <!-- Whatsapp -->
					<div class="whatsapp">
						<a href="https://api.whatsapp.com/send?phone=5491153117118&text=Hola!%20Necesito%20hacer%20una%20consulta!" target="_blank">
							<img src="img/whatsap.png" alt="whatsapp">
						</a>
						<p>
							<strong>WhatsApp</strong><br>
							Lu. - Vi.<br>
							08 - 17 hs.
						</p>
					</div>
					<!-- Whatsapp end -->

				</div>

			</div>
		</header>
		<!-- HEADER end -->

		<!-- FORMULARIO ESCRITORIO -->
		<section class="container-fluid header_imagen p-0 mb-5">
			<div class="container">

				<div class="row">

					<div class="col-lg-7 col-md-12 wow fadeIn">
						<div class="faja">
							<h1>LÍNEA <br> <span class="font-weight-bold">MUEBLES DE EXTERIOR</span></h1>
							<h2>
								Fabricados con tubo estructural de aluminio anodizado, son resistentes a la interperie y no necesitan mantenimiento.
							</h2>
						</div>
					</div>

					<div class="col-lg-5 col-md-12">

						<form id="formulario" class="formulario wow fadeIn" method="post">
							<h3 class="text-center ">¿Necesitas cotizar un producto?</h3>
							<h4 class="text-center ">Envianos tú consulta hoy mismo!</h4>
					    
					    <input name="rubro" type="hidden" value="Muebles de Exterior">
				    	<input name="origin" type="hidden" value="Landing Muebles">

						  <div class="form-group">
						    <input required name="name" type="text" class="form-control" placeholder="nombre" value="<?= $name ?>">
						  </div>

						  <div class="form-group">
						    <input required name="email" type="email" class="form-control" placeholder="email" value="<?= $email ?>">
						  </div>

						  <div class="form-group">
						    <input required name="phone" type="tel" class="form-control" placeholder="teléfono" value="<?= $phone ?>">
						  </div>

						  <textarea required class="form-control" name="comments" rows="4" placeholder="Que necesitás?"><?= $comments ?></textarea>

						  <div class="form-group form-check">
						    <input checked name="newsletter" type="checkbox" class="form-check-input" value="Si" id="exampleCheck1">
						    <label class="form-check-label" for="exampleCheck1">Suscribe newsletter</label>
						  </div>

					  	<!-- reCAPTCHA  -->
			  			<div id="recaptcha" class="g-recaptcha" data-sitekey="6LfNPGAUAAAAAFlbBq-VyrRY5_FCjC6xZdWBGV1U"></div>

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

		<!-- FAJA MOBILE -->
		<section class="faja_mobile container-fluid text-center">

			<div class="row">
				<div class="col-sm-12 p-0">
					<h3>LÍNEA <strong>MUEBLES DE EXTERIOR</strong></h3>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12">
					<p>
						Fabricados con tubo estructural de aluminio anodizado, son resistentes a la interperie y no necesitan mantenimiento.
					</p>
				</div>
			</div>

		</section>
		<!-- FAJA MOBILE end -->
		

		<!-- CARACTERISTICAS -->
		<section class="container mb-5 section_caracteristicas">

			<div class="row mb-3">
				<div class="col-md-8 offset-md-2 wow fadeInLeft text-center">
					<p>
						Nuestros muebles de exterior o muebles de jardín están fabricados en una aleación de aluminio especial, mediante un proceso de anodizado crea un material que no se daña y es inoxidable. <strong>Su acabado es suave y uniforme.</strong>
					</p>					
				</div>
			</div>

		  <div class="row caracteristicas">

		    <div class="col-lg-5 offset-lg-1 col-sm-8 offset-sm-2 mb-2">

		  		<div class="d-flex align-items-center wow fadeInUp mb-3">
		    		<img class="mr-2" src="img/tilde.png" alt="soporte 1">
			    	<p class="d-flex align-items-center m-0">
			    		Libres de Mantenimiento.
			    	</p>
		  		</div>

		  		<div class="d-flex align-items-center wow fadeInUp mb-3">
		    		<img class="mr-2" src="img/tilde.png" alt="soporte 2">
			    	<p class="d-flex align-items-center m-0">
			    		Resistentes a la decoloración y las manchas. 
			    	</p>
		  		</div>

		    </div>

		    <div class="col-lg-5 offset-lg-1 col-sm-8 offset-sm-2 mb-2">

		  		<div class="d-flex align-items-center wow fadeInUp mb-3">
		    		<img class="mr-2" src="img/tilde.png" alt="soporte 4">
			    	<p class="d-flex align-items-center m-0">
			    		Superior a la Madera.
			    	</p>
		  		</div>

		  		<div class="d-flex align-items-center wow fadeInUp mb-3">
		    		<img class="mr-2" src="img/tilde.png" alt="soporte 5">
			    	<p class="d-flex align-items-center m-0">
			    		No se pudren, no se deforman.
			    	</p>
		  		</div>
		  		
		    </div>

		  </div>

		</section>
		<!-- CARACTERISTICAS end -->

		<!-- FAJA GRIS -->
		<section class="container-fluid bg_gris text-center mb-5">
			<div class="container">
				<div class="row">
					<div class="col-md-8 offset-md-2">
						<div class="wow fadeInUp">
							Ofrecemos soluciones integrales de mobiliarios para amenities, sum de edificios, torres, hoteles, countries y empresas. <strong>Ponemos a su alcance las últimas tendencias en diseño y calidad.</strong>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- FAJA GRIS end -->

		<!-- CATEGORIAS PRODUCTOS -->
		<section class="container text-center mb-5">
			<div class="row">

				<div class="col-md-4 col-sm-6 text-center mb-4">
					<div class="card">
					  <img class="card-img-top" src="img/pergolas.jpg" alt="pergolas">
					  <div class="card-body">
					    <h5 class="card-title">PERGOLAS</h5>
					    <p class="card-text">Cómodas, amplias. <br> La mejor elección para disfrutar de tu jardín y la piscina.</p>
					    <a href="#formulario" class="btn btn_site toForm transition">CONSULTAR</a>
					  </div>
					</div>
				</div>

				<div class="col-md-4 col-sm-6 mb-4">
					<div class="card">
					  <img class="card-img-top" src="img/sillones.jpg" alt="sillones">
					  <div class="card-body">
					    <h5 class="card-title">SILLONES</h5>
					    <p class="card-text">fabricados en aluminio anodizado. Excelente acabado. Especial para terrazas.</p>
					    <a href="#formulario" class="btn btn_site toForm transition">CONSULTAR</a>
					  </div>
					</div>
				</div>

				<div class="col-md-4 col-sm-6 mb-4">
					<div class="card">
					  <img class="card-img-top" src="img/reposeras.jpg" alt="reposeras">
					  <div class="card-body">
					    <h5 class="card-title">REPOSERAS</h5>
					    <p class="card-text">Reposeras con las últimas tendencias del diseño. Comenzá a disfrutar del sol y tu piscina.</p>
					    <a href="#formulario" class="btn btn_site toForm transition">CONSULTAR</a>
					  </div>
					</div>
				</div>

				<div class="col-md-4 col-sm-6 mb-4">
					<div class="card">
					  <img class="card-img-top" src="img/tijeras.jpg" alt="reposeras tijera">
					  <div class="card-body">
					    <h5 class="card-title">REPOSERAS TIJERA</h5>
					    <p class="card-text">Reposera tipo tijera para tus tardes de verano. Excelente postura, gran terminación.</p>
					    <a href="#formulario" class="btn btn_site toForm transition">CONSULTAR</a>
					  </div>
					</div>
				</div>

				<div class="col-md-4 col-sm-6 mb-4">
					<div class="card">
					  <img class="card-img-top" src="img/mesas.jpg" alt="mesas">
					  <div class="card-body">
					    <h5 class="card-title">MESAS</h5>
					    <p class="card-text">Mesas para exterior. Ámplias y súper cómodas. Ideales para compartir comidas al aire libre.</p>
					    <a href="#formulario" class="btn btn_site toForm transition">CONSULTAR</a>
					  </div>
					</div>
				</div>

				<div class="col-md-4 col-sm-6 mb-4">
					<div class="card">
					  <img class="card-img-top" src="img/desayunador.jpg" alt="desayunador">
					  <div class="card-body">
					    <h5 class="card-title">MESAS DESAYUNADOR</h5>
					    <p class="card-text">Comenzá tu día del mejor modo. Mesas desayunador, fabricadas en aluminio anodizado.</p>
					    <a href="#formulario" class="btn btn_site toForm transition">CONSULTAR</a>
					  </div>
					</div>
				</div>

			</div>
		</section>
		<!-- CATEGORIAS PRODUCTOS end -->

		<!-- FAJA VERDE -->
		<section class="container-fluid bg_verde text-center mb-5">
			<div class="container">
				<div class="row">
					<div class="col-md-8 offset-md-2">
						<div class="wow fadeInUp">
							<h2>TECNOLOGÍA, DISEÑO Y DURABILIDAD</h2>
							Gracias a la tecnología de su construcción, son libres de mantenimiento a diferencia de otros muebles de exterior en materiales como madera, rattan o plástico, <strong>no se deterioran en la intemperie.</strong>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- FAJA VERDE end -->

		<!-- TEXTO + IMAGEN -->
		<section class="container mb-5">

			<div class="row mb-5">
				<div class="col-md-8 offset-md-2 text-center wow fadeInLeft">
					<p>
						Fabricados con tubo estructural de aluminio anodizado, se distingue por sus propiedades de resistencia, 
						ligereza y versatilidad. Es un metal reciclable que protege el medio ambiente, posee un bajo consumo energético 
						y no es tóxico. Es uno de los materiales más adecuados para muebles de exterior (outside furniture) dado que 
						se mantiene en buenas condiciones durante años porque <strong>no se oxida y es de fácil mantenimiento.</strong>
					</p>					
				</div>
			</div>

		  <div class="row">

		    <div class="col-md-10 offset-md-1 muebles_resistentes p-0">
					<h2>Muebles resistentes. <br><strong>a la interperie.</strong></h2>
		    </div>

		  </div>

		</section>
		<!-- TEXTO + IMAGEN end -->

		<!-- FAJA GRIS -->
		<section class="container-fluid bg_gris text-center mb-5">
			<div class="container">
				<div class="row">
					<div class="col-md-8 offset-md-2">
						<div class="wow fadeInUp">
							<strong>Gran variedad de telas con diferentes texturas para sus tapizados, todas aptas para permanecer a la intemperie.</strong>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- FAJA GRIS end -->

		<!-- TITULO -->
		<section class="container mb-3">

			<div class="row mb-3">
				<div class="col-md-8 offset-md-2 text-center wow fadeInLeft">
					<p>
						<strong>REDEFINÍ TU ESPACIO EXTERIOR</strong> <br>
						GALERÍAS, PATIOS, TERRAZAS, BALCONES O JARDINES, <br>
						PUEDEN LUCIR COMO SIEMPRE SOÑASTE. 
					</p>
				</div>
			</div>

		</section>
		<!-- TITULO end -->

		<!-- GALERIA -->
		<?php include_once('includes/galeria.inc'); ?>

		<!-- TITULO -->
		<section class="container text-center mb-5">
			<div class="row">
				<div class="col-md-12">
					<a href="#formulario" class="btn btn_site toForm transition">COTIZAR PRODUCTOS</a>
				</div>
			</div>
		</section>
		<!-- TITULO end -->

		<footer class="container-fluid">
			<div class="container text-center">
				<div class="row mb_15">
					<div class="col-md-8 offset-md-2 align_vertical_horizontal">
						<div class="transition mail">
							
							<a class="toForm" href="#formulario"><img src="img/mail.png" alt="mail">info@nordeco.com.ar</a>
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
	  <!-- jQuery primero, luego Bootstrap JS -->
	  <script type="text/javascript" src="js/jquery.min.js"></script>
	  <script type="text/javascript" src="js/bootstrap.min.js"></script>

	  <!-- Jquery easing -->
    <script type="text/javascript" src="js/jquery.easing.1.3.min.js"></script>

	  <!-- Wow efecto para que aparezcan los objetos cuando se va scroleando -->
		<script type="text/javascript" src="js/wow.min.js"></script>

		<!-- Plugin Slick (Carrousel logos) JS -->
    <script src="plugins/slick.min.js" type="text/javascript" charset="utf-8"></script>

    <!-- Magnific Popup javascript -->
		<script type="text/javascript" src="plugins/magnific-popup/jquery.magnific-popup.min.js"></script>

		<!-- Comunes a todos las paginas -->
		<script type="text/javascript" src="js/app.js"></script>
	</body>
</html>