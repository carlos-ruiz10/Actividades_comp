<?php
	require_once('../conexion/conexion.php');
	$title = 'Agregar un nuevo registro';


	
	$sql_estudiante = 'SELECT * FROM instituto, estudiante, trabajador, actividad_comp';
	$statement = $pdo->prepare($sql_estudiante);
	$statement->execute();
	$results = $statement->fetchAll();



	if( $_POST )
	{

  		$sql_insert = 'INSERT INTO solicitud ( fecha, asunto, folio, instituto_clave, estudiante_n_control, actividad_comp_clave_act, trabajador_rfc ) VALUES( ?, ?, ?, ?, ?, ? ,?)';

  		$fecha = isset($_POST['fecha']) ? $_POST['fecha']: '';
  		$asunto = isset($_POST['asunto']) ? $_POST['asunto']: '';
  		$folio = isset($_POST['folio']) ? $_POST['folio']: '';
  		$instituto_clave = isset($_POST['instituto_clave']) ? $_POST['instituto_clave']: '';
  		$estudiante_n_control = isset($_POST['estudiante_n_control']) ? $_POST['estudiante_n_control']: '';
  		$actividad_comp_clave_act = isset($_POST['actividad_comp_clave_act']) ? $_POST['actividad_comp_clave_act']: '';
  		$trabajador_rfc = isset($_POST['trabajador_rfc']) ? $_POST['trabajador_rfc']: '';

  		$statement_insert = $pdo->prepare($sql_insert);
  		$statement_insert->execute(array($fecha,$asunto,$folio, $instituto_clave,$estudiante_n_control,$actividad_comp_clave_act,$trabajador_rfc));

	}

	$sql_status = 'SELECT solicitud.*, instituto.nombre FROM solicitud INNER JOIN instituto ON instituto.clave = solicitud.instituto_clave';
	$sql_status = 'SELECT solicitud.*, estudiante.nombre_estudiante FROM solicitud INNER JOIN estudiante ON estudiante.n_control = solicitud.estudiante_n_control';
	$sql_status = 'SELECT solicitud.*, actividad_comp.nombre_act FROM solicitud INNER JOIN actividad_comp ON actividad_comp.clave_act = solicitud.actividad_comp_clave_act';
	$sql_status = 'SELECT solicitud.*, trabajador.nombre_tra FROM solicitud INNER JOIN trabajador ON trabajador.rfc_tra = solicitud.trabajador_rfc';
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
                <a href="#" class="brand-logo right">Solicitudes</a>
                <ul id="nav-mobile" class="left side-nav">
                    <li><a href="index.php">Inicio</a></li>
                </ul>
            </div>
        </nav>
    </div>
		<div class="container">
			<div class="row">
				<div class="col s12">
					<h2>Agregar una nueva solicitud</h2>
					<hr>
				</div>
			</div>

			<div class="row">
				<form method="post" class="col s12">
					<div class="row">
						<div class="input-field col s12">
          				<input placeholder="Fecha" name="fecha" type="text">
        				</div>
					</div>
			<div class="row">
						<div class="input-field col s12">
          				<input placeholder="Asunto" name="asunto" type="text">
        				</div>
					</div>
			<div class="row">
						<div class="input-field col s12">
          				<input placeholder="Folio" name="folio" type="text">
        				</div>
					</div>

					<div class="row">
        				<div class="input-field col s6">
                  		<select name="instituto_clave">
                  			<option value="" disabled selected>Elige la institucion</option>
                  			<?php 
				        	foreach($results as $rs) {
				        	?>
  							<option value="<?php echo $rs['clave']?>"><?php echo $rs['nombre']?></option>
  							<?php 
				          	}
				        ?>
						</select>
						<label>Institucion</label>
						</div>
        				<div class="input-field col s6">
                  		<select name="estudiante_n_control">
                  			<option value="" disabled selected>Elige el estudiante</option>
                  			<?php 
				        	foreach($results as $rs) {
				        	?>
  							<option value="<?php echo $rs['n_control']?>"><?php echo $rs['n_control']?></option>
  							<?php 
				          	}
				        ?>
						</select>
						<label>Estudiante</label>
						</div>
        			</div>
        			<div class="row">
        				<div class="input-field col s6">
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
        				<div class="input-field col s6">
                  		<select name="trabajador_rfc">
                  			<option value="" disabled selected>Elige el trabajador</option>
                  			<?php 
				        	foreach($results as $rs) {
				        	?>
  							<option value="<?php echo $rs['rfc_tra']?>"><?php echo $rs['nombre_tra']?></option>
  							<?php 
				          	}
				        ?>
						</select>
						<label>Trabajador</label>
						</div>
        			</div>

		
        			<input class="btn waves-effect waves-light orange" type="submit" value="Agregar" />
        		</form>
      		</div>
			<div class="row">
				<div class="col s12">
				    <h3>Solicitudes</h3>
				    <table class="striped">
					  <thead>
					    <tr>
					    	<th>Fecha</th>
				          	<th>Asunto</th>
				            <th>Folio</th>
				            <th>Instituto</th>
				            <th>Estudiante</th>
				            <th>Actividad</th>
				            <th>Trabajador</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php 
				        	foreach($results_status as $rs2) {
				        ?>
					    <tr>
					    	<td><?php echo $rs2['fecha']?></td>
							<td><?php echo $rs2['asunto']?></td>
							<td><?php echo $rs2['folio']?></td>
							<td><?php echo $rs2['instituto_clave']?></td>
							<td><?php echo $rs2['estudiante_n_control']?></td>
							<td><?php echo $rs2['actividad_comp_clave_act']?></td>
							<td><?php echo $rs2['trabajador_rfc']?></td>
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