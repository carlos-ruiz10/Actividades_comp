<?php
require_once('../conexion/conexion.php');
$rfc_tra = isset($_GET['rfc_tra']) ? $_GET['rfc_tra'] : 0 ;
$sql = 'DELETE FROM trabajador WHERE rfc_tra = ?';

$statement = $pdo->prepare($sql);
$statement->execute(array($rfc_tra));

$results = $statement->fetchAll();
header('Location: trabajador.php');
?>