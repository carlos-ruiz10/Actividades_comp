<?php
	require_once('../conexion/conexion.php');
?>
<?php
	$sql_departamento = 'SELECT * FROM departamento WHERE nombre_dep LIKE :search';
	$search_terms = isset($_GET['nombre_dep'])? $_GET["nombre_dep"]: '';
	$arr_sql_terms[':search'] = '%' . $search_terms .'%';
	$statement_departamento = $pdo->prepare($sql_departamento);
	$statement_departamento->execute($arr_sql_terms);
	$results_departamento = $statement_departamento->fetchAll();

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
                <a href="#" class="brand-logo right">Departamentos</a>
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
									<label>Ingrese el nombre del departamento
										<input type="text" name="nombre_dep" placeholder="ej. Finanzas">
											<input class="button" type="submit" value="Buscar"/>
										</label>
									</div>
								</div>
							</form>
              <h3>Departamento</h3>
    					<hr>
    					<table class="striped">
    				        <thead>
    				          <tr>
    				              <th>Clave Departamento</th>
    				              <th>Nombre departamento</th>
                                  <th>RFC Trabajador</th>
    				          </tr>
    				        </thead>
    				        <tbody>
    				        	<?php
    				        		foreach($results_departamento as $rs) {
    				        	?>
    				          <tr>
    							<td><?php echo $rs['rfc_dep']?></td>
    							<td><?php echo $rs['nombre_dep']?></td>
    							<td><?php echo $rs['trabajador_rfc']?></td>
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
