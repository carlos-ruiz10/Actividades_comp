<?php
	require_once('../conexion/conexion.php');
	$title = 'Agregar un nuevo registro';
  $sql_trabajador = 'SELECT * FROM trabajador ORDER BY nombre_tra';
	$statement_trabajador= $pdo->prepare($sql_trabajador);
	$statement_trabajador->execute(array());
	$results_trabajador=$statement_trabajador->fetchAll();

	if( $_POST )
	{
  		$sql_insert = 'INSERT INTO departamento (rfc_dep, nombre_dep, trabajador_rfc) VALUES( ?, ?, ?)';
  		$rfc_dep = isset($_POST['rfc_dep']) ? $_POST['rfc_dep']: '';
  		$nombre_dep = isset($_POST['nombre_dep']) ? $_POST['nombre_dep']: '';
  		$trabajador_rfc = isset($_POST['trabajador_rfc']) ? $_POST['trabajador_rfc']: '';
  		$statement_insert = $pdo->prepare($sql_insert);
  		$statement_insert->execute(array($rfc_dep, $nombre_dep, $trabajador_rfc));
	}

  $sql_trabajador = 'SELECT departamento.*, trabajador.nombre_tra FROM departamento INNER JOIN trabajador
  ON trabajador.rfc_tra = departamento.trabajador_rfc';
  $statement_trabajador = $pdo->prepare($sql_trabajador);
  $statement_trabajador->execute();
  $results_status = $statement_trabajador->fetchAll();

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<title><?php echo $title?></title>
		<link rel="stylesheet" href="../css/materialize.css">
		</head>

	<body>
		<!--Import jQuery before materialize.js-->
    	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    	<script type="text/javascript" src="js/materialize.min.js"></script>
    	<div class="navbar-fixed">
        <nav class="red accent-4">
            <div class="nav-wrapper">
                <a href="#" class="brand-logo right">Departamento</a>
                <ul id="nav-mobile" class="left side-nav">
                    <li><a href="index.php">Inicio</a></li>
                </ul>
            </div>
        </nav>
    </div>
		<div class="container">
			<div class="row">
				<div class="col s12">
					<h2>Agregar un nuevo departamento</h2>
					<hr>
				</div>
			</div>
			<div class="row">
				<form method="post" class="col s12">
					<div class="row">
						<div class="input-field col s12">
          				<input placeholder="RFC del departamento" name="rfc_dep" type="text">
        				</div>
					</div>
					<div class="row">
        				<div class="input-field col s12">
          				<input placeholder="Departamento" name="nombre_dep" type="text">
        				</div>
							</div>
        				<div class="row">
        				<div class="input-field col s12">
									<select name="trabajador_rfc">
											<option value="" disabled selected>Elige el nombre del trabajador</option>
                  			<?php
				        	foreach($results_trabajador as $rs) {
				        	?>
  							<option value="<?php echo $rs['rfc_tra']?>"><?php echo $rs['nombre_tra']?> </option>
  							<?php
				          	}
				        ?>
						</select>
        			<input class="btn waves-effect waves-light orange" type="submit" value="Agregar" />
        		</form>
      		</div>
					</div>
          <h3>Departamento</h3>
					<hr>
					<table class="striped">
				        <thead>
				          <tr>
				              <th>RFC</th>
				              <th>Nombre Depto</th>
											<th>Rfc trabajador</th>
				          </tr>
				        </thead>
				        <tbody>
				        	<?php
				        		foreach($results_status as $rs) {
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
		<!--  Scripts-->
    	<!--Import jQuery before materialize.js-->
      	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      	<script type="text/javascript" src="../js/materialize.min.js"></script>
      	<script>
      		$(document).ready(function() {
    		$('select').material_select();
  			});
      	</script>
	</body>