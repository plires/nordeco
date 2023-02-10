<?php

// local 
// $dsn = 'mysql:host=localhost;dbname=imagenes;charset=utf8mb4;port:8889';

// Remoto
$dsn = 'mysql:host=localhost;dbname=duck7_productos;charset=utf8;port:3306';
$db_user = 'duck7_plires';
$db_pass = 'perezzs7478';

try {
	$db = new PDO($dsn, $db_user, $db_pass);
}
catch( PDOException $Exception ) {
	echo 'No se pudo conectar a la base de datos, intente mas tarde...';
}

?>