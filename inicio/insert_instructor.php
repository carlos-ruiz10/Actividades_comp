<?php
	require_once('../conexion/conexion.php');
	$title = 'Agregar un nuevo registro';
	$sql_instructor = 'SELECT * FROM actividad_comp';

	$statement = $pdo->prepare($sql_instructor);
	$statement->execute();
	$results = $statement->fetchAll();

	if( $_POST )
	{

  		$sql_insert = 'INSERT INTO instructor ( rfc_inst, nombre, a_paterno, a_materno, actividad_comp_clave_act ) VALUES( ?, ?, ?, ?, ? )';

  		$rfc_inst = isset($_POST['rfc_inst']) ? $_POST['rfc_inst']: '';
  		$nombre = isset($_POST['nombre']) ? $_POST['nombre']: '';
  		$a_paterno = isset($_POST['a_paterno']) ? $_POST['a_paterno']: '';
  		$a_materno = isset($_POST['a_materno']) ? $_POST['a_materno']: '';
  		$actividad_comp_clave_act = isset($_POST['actividad_comp_clave_act']) ? $_POST['actividad_comp_clave_act']: '';

  		$statement_insert = $pdo->prepare($sql_insert);
  		$statement_insert->execute(array($rfc_inst,$nombre,$a_paterno, $a_materno,$actividad_comp_clave_act));

	}

	$sql_status = 'SELECT instructor.*, actividad_comp.nombre_act FROM instructor INNER JOIN actividad_comp ON actividad_comp.clave_act = instructor.actividad_comp_clave_act';
	$statement_status = $pdo->prepare($sql_status);
	$statement_status->execute();
	$results_status = $statement_status->fetchAll();
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
                <a href="#" class="brand-logo right">Instructor</a>
                <ul id="nav-mobile" class="left side-nav">
                    <li><a href="index.php">Inicio</a></li>
                </ul>
            </div>
        </nav>
    </div>
		<div class="container">
			<div class="row">
				<div class="col s12">
					<h2>Agregar un nuevo instructor</h2>
					<hr>
				</div>
			</div>
			<div class="row">
				<form method="post" class="col s12">
					<div class="row">
						<div class="input-field col s12">
          				<input placeholder="RFC" name="rfc_inst" type="text">
        				</div>
					</div>
					<div class="row">
        				<div class="input-field col s4">
          				<input placeholder="Nombre" name="nombre" type="text">
        				</div>
        				<div class="input-field col s4">
          				<input placeholder="Apellido Paterno" name="a_paterno" type="text">
        				</div>
        				<div class="input-field col s4">
          				<input placeholder="Apellido Materno" name="a_materno" type="text">
        				</div>
        			</div>
        			
        			<div class="row">
        				<div class="input-field col s12">
                  		<select name="actividad_comp_clave_act">
                  			<option value="" disabled selected>Elige la actividad</option>
                  			<?php 
				        	foreach($results as $rs) {
				        	?>
  							<option value="<?php echo $rs['clave_act']?>"><?php echo $rs['nombre_act']?></option>
  							<?php 
				          	}
				        ?>
						</select>
						<label>Actividad</label>
						</div>
        			</div>
        			<input class="btn waves-effect waves-light orange" type="submit" value="Agregar" />
        		</form>
      		</div>
			<div class="row">
				<div class="col s12">
				    <h3>Intructores</h3>
				    <table class="striped">
					  <thead>
					    <tr>
					    	<th>RFC</th>
				          	<th>Nombre</th>
				            <th>Apellido Paterno</th>
				            <th>Apellido Materno</th>
				            <th>Actividad Complementaria</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php 
				        	foreach($results_status as $rs2) {
				        ?>
					    <tr>
					    	<td><?php echo $rs2['rfc_inst']?></td>
							<td><?php echo $rs2['nombre']?></td>
							<td><?php echo $rs2['a_paterno']?></td>
							<td><?php echo $rs2['a_materno']?></td>
							<td><?php echo $rs2['actividad_comp_clave_act']?></td>
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
</html>