<?php 

$dsn = 'mysql:dbname=actividad_complementaria;host=localhost';
$user = 'carlos';
$password = 'c1a9r9g5';
    
   try{
    
        $pdo = new PDO( $dsn,
                        $user,
                        $password
                        );
 }catch( PDOException $e ){
     echo 'Error al conectarnos: ' . $e->getMessage();
 }
?>