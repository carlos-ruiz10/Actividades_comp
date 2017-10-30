<?php
	require_once('../conexion/conexion.php');
?>
<?php
	$sql = 'SELECT * FROM instituto WHERE nombre LIKE :search';
	$search_terms = isset($_GET['nombre'])? $_GET["nombre"]: '';
	$arr_sql_terms[':search'] = '%' . $search_terms .'%';
	$statement_instituto = $pdo->prepare($sql);
	$statement_instituto->execute($arr_sql_terms);
	$results_instituto = $statement_instituto->fetchAll();

	?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<title>Buscador</title>
		<link rel="stylesheet" href="../css/materialize.min.css">
		</head>

	<body>
		<!--Import jQuery before materialize.js-->
    	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    	<script type="text/javascript" src="js/materialize.min.js"></script>
    	<div class="navbar-fixed">
        <nav class="red accent-4">
            <div class="nav-wrapper">
                <a href="#" class="brand-logo right">Instituto</a>
                <ul id="nav-mobile" class="left side-nav">
                    <li><a href="index.php">Inicio</a></li>
                </ul>
            </div>
        </nav>
    </div>
		<div class="container">
			<div class="row">
				<div class="col s12">
					<h2>Buscador sencillo con like</h2>
					<hr>
					<form method="get">
							<div class="row">
								<div class="col s12">
									<label>Ingrese el nombre del instituto
										<input type="text" name="nombre" placeholder="ej. ITCA">
											<input class="button" type="submit" value="Buscar"/>
										</label>
									</div>
								</div>
							</form>
              <h3>Instituto</h3>
    					<hr>
    					<table class="striped">
    				        <thead>
    				          <tr>
    				              <th>Clave Instituto</th>
    				              <th>Nombre Instituto</th>
    				          </tr>
    				        </thead>
    				        <tbody>
    				        	<?php
    				        		foreach($results_instituto as $rs) {
    				        	?>
    				          <tr>
    							<td><?php echo $rs['clave']?></td>
    							<td><?php echo $rs['nombre']?></td>
    				          </tr>
    				          <?php
    				          	}
    				          ?>
    				        </tbody>
    				    </table>
    				</div>
    			</div>
			<div class="col s12">
                <footer class="page-footer red accent-4">
                    <div class="footer-copyright">
                        <div class="container">
                            &copy; 2017 CARLOS ALBERTO RUIZ GUTI&Eacute;RREZ
                        </div>
                    </div>
                </footer>
            </div>
		</div>
	</body>
</html>
