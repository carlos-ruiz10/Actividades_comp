<?php
	require_once('../conexion/conexion.php');
	$title = 'Agregar un nuevo registro';
	$sql_carrera = 'SELECT * FROM carrera';

	$statement = $pdo->prepare($sql_carrera);
	$statement->execute();
	$results = $statement->fetchAll();

	if( $_POST )
	{

  		$sql_insert = 'INSERT INTO estudiante ( n_control, nombre_estudiante, a_paterno_e, a_materno_e, semestre, carrera_clave ) VALUES( ?, ?, ?, ?, ?, ? )';

  		$n_control = isset($_POST['n_control']) ? $_POST['n_control']: '';
  		$nombre_estudiante = isset($_POST['nombre_estudiante']) ? $_POST['nombre_estudiante']: '';
  		$a_paterno_e = isset($_POST['a_paterno_e']) ? $_POST['a_paterno_e']: '';
  		$a_materno_e = isset($_POST['a_materno_e']) ? $_POST['a_materno_e']: '';
  		$semestre = isset($_POST['semestre']) ? $_POST['semestre']: '';
  		$carrera_clave = isset($_POST['carrera_clave']) ? $_POST['carrera_clave']: '';

  		$statement_insert = $pdo->prepare($sql_insert);
  		$statement_insert->execute(array($n_control,$nombre_estudiante,$a_paterno_e, $a_materno_e,$semestre,$carrera_clave));

	}

	$sql_status = 'SELECT estudiante.*, carrera.nombre_carrera FROM estudiante INNER JOIN carrera ON carrera.clave_carrera = estudiante.carrera_clave';
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
                <a href="#" class="brand-logo right">Estudiantes</a>
                <ul id="nav-mobile" class="left side-nav">
                    <li><a href="index.php">Inicio</a></li>
                </ul>
            </div>
        </nav>
    </div>
		<div class="container">
			<div class="row">
				<div class="col s12">
					<h2>Agregar un nuevo estudiante</h2>
					<hr>
				</div>
			</div>
			<div class="row">
				<form method="post" class="col s12">
					<div class="row">
						<div class="input-field col s12">
          				<input placeholder="Número de control" name="n_control" type="text">
        				</div>
					</div>
					<div class="row">
        				<div class="input-field col s4">
          				<input placeholder="Nombre" name="nombre_estudiante" type="text">
        				</div>
        				<div class="input-field col s4">
          				<input placeholder="Apellido Paterno" name="a_paterno_e" type="text">
        				</div>
        				<div class="input-field col s4">
          				<input placeholder="Apellido Materno" name="a_materno_e" type="text">
        				</div>
        			</div>
        			<div class="row">
        				<div class="input-field col s12">
    						<select name="semestre">
	      						<option value="" disabled selected>Elige el semestre</option>
	      						<option value="I">I</option>
	  							<option value="II">II</option>
	  							<option value="III">III</option>
	  							<option value="IV">IV</option>
	  							<option value="V">V</option>
	  							<option value="VI">VI</option>
	  							<option value="VII">VII</option>
	  							<option value="VIII">VIII</option>
    						</select>
    						<label>Semestre</label>
  						</div>
        			</div>
        			<div class="row">
        				<div class="input-field col s12">
                  		<select name="carrera_clave">
                  			<option value="" disabled selected>Elige la carrera</option>
                  			<?php 
				        	foreach($results as $rs) {
				        	?>
  							<option value="<?php echo $rs['clave_carrera']?>"><?php echo $rs['nombre_carrera']?></option>
  							<?php 
				          	}
				        ?>
						</select>
						<label>Carrera</label>
						</div>
        			</div>
        			<input class="btn waves-effect waves-light orange" type="submit" value="Agregar" />
        		</form>
      		</div>
			<div class="row">
				<div class="col s12">
				    <h3>Estudiantes</h3>
				    <table class="striped">
					  <thead>
					    <tr>
					    	<th>No Control</th>
				          	<th>Nombre</th>
				            <th>Apellido Paterno</th>
				            <th>Apellido Materno</th>
				            <th>Semestre</th>
				            <th>Carrera</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php 
				        	foreach($results_status as $rs2) {
				        ?>
					    <tr>
					    	<td><?php echo $rs2['n_control']?></td>
							<td><?php echo $rs2['nombre_estudiante']?></td>
							<td><?php echo $rs2['a_paterno_e']?></td>
							<td><?php echo $rs2['a_materno_e']?></td>
							<td><?php echo $rs2['semestre']?></td>
							<td><?php echo $rs2['carrera_clave']?></td>
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