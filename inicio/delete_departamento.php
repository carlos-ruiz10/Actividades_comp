<?php
require_once('../conexion/conexion.php');
$rfc_dep = isset($_GET['rfc_dep']) ? $_GET['rfc_dep'] : 0 ;
$sql = 'DELETE FROM departamento WHERE rfc_dep = ?';

$statement = $pdo->prepare($sql);
$statement->execute(array($rfc_dep));

$results = $statement->fetchAll();
header('Location: departamento.php');
?>