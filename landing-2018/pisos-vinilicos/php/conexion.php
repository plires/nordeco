<?php

$dsn = 'mysql:host=localhost;dbname=duck7_adwords;charset=utf8mb4;port:3306';
$db_user = 'duck7_plires';
$db_pass = 'perezzs7478';

$db = new PDO($dsn, $db_user, $db_pass);

$sql = "INSERT INTO consultas values(default, :nombre, :email, :telefono, :consulta, :suscribe, :fecha, :rubro, :origen)";
$stmt = $db->prepare($sql);

$stmt->bindValue(":nombre", $name, PDO::PARAM_STR);
$stmt->bindValue(":email", $email, PDO::PARAM_STR);
$stmt->bindValue(":telefono", $phone, PDO::PARAM_STR);
$stmt->bindValue(":consulta", $comments, PDO::PARAM_STR);
$stmt->bindValue(":suscribe", $newsletter, PDO::PARAM_STR);
$stmt->bindValue(":fecha", $date, PDO::PARAM_STR);
$stmt->bindValue(":rubro", $rubro, PDO::PARAM_STR);
$stmt->bindValue(":origen", $origin, PDO::PARAM_STR);

$stmt->execute();

$db = null;

?>