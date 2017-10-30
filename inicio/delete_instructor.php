<?php
require_once('../conexion/conexion.php');
$rfc_inst = isset($_GET['rfc_inst']) ? $_GET['rfc_inst'] : 0 ;
$sql = 'DELETE FROM instructor WHERE rfc_inst = ?';

$statement = $pdo->prepare($sql);
$statement->execute(array($rfc_inst));

$results = $statement->fetchAll();
header('Location: instructor.php');
?>