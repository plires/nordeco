<?php

$dsn = 'mysql:host=localhost;dbname=provisoria;port:3306';
$db_user = 'root';
$db_pass = 'root';

$db = new PDO($dsn, $db_user, $db_pass);

$sql = "INSERT INTO newsletter values(default, :nombre, :mail, :telefono, :consulta, :rubro, :suscribe, :fecha, :origen)";
$stmt = $db->prepare($sql);

$stmt->bindValue(":nombre", $name, PDO::PARAM_STR);
$stmt->bindValue(":mail", $email, PDO::PARAM_STR);
$stmt->bindValue(":telefono", $phone, PDO::PARAM_STR);
$stmt->bindValue(":consulta", $comments, PDO::PARAM_STR);
$stmt->bindValue(":rubro", $rubro, PDO::PARAM_STR);
$stmt->bindValue(":suscribe", $newsletter, PDO::PARAM_STR);
$stmt->bindValue(":fecha", $date, PDO::PARAM_STR);
$stmt->bindValue(":origen", $origin, PDO::PARAM_STR);

$stmt->execute();

$db = null;

?>