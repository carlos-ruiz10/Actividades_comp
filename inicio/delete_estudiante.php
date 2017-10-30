<?php
require_once('../conexion/conexion.php');
$n_control = isset($_GET['n_control']) ? $_GET['n_control'] : 0 ;
$sql = 'DELETE FROM estudiante WHERE n_control = ?';

$statement = $pdo->prepare($sql);
$statement->execute(array($n_control));

$results = $statement->fetchAll();
header('Location: estudiante.php');
?>