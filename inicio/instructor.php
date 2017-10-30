<?php
	require_once('../conexion/conexion.php');
	$title = 'Instructores';
	$title_menu = 'Instructores';

	// Consulta para mostrar los datos de la tabla "actividad_comp"
	$sql_act = 'SELECT * FROM actividad_comp';
	$statement = $pdo->prepare($sql_act);
	$statement->execute();
	$results = $statement->fetchAll();

	$show_form = FALSE;

	if($_POST)
	{
	  	//TODO:UPDATE ARTICLE
	  	$sql_update_details = 'UPDATE instructor SET rfc_inst = ?, nombre = ?,
			a_paterno = ?, a_materno = ?, actividad_comp_clave_act= ?
			WHERE rfc_inst = ?';

			$rfc_inst = isset($_GET['rfc_inst']) ? $_GET['rfc_inst']: '';
			$rfc_inst_2 = isset($_POST['rfc_inst_2']) ? $_POST['rfc_inst_2']: '';
  		$nombre = isset($_POST['nombre']) ? $_POST['nombre']: '';
  		$a_paterno = isset($_POST['a_paterno']) ? $_POST['a_paterno']: '';
  		$a_materno = isset($_POST['a_materno']) ? $_POST['a_materno']: '';
  		$actividad_comp_clave_act = isset($_POST['actividad_comp_clave_act']) ? $_POST['actividad_comp_clave_act']: '';

	  	$statement_update_details = $pdo->prepare($sql_update_details);
	  	$statement_update_details->execute(array($rfc_inst_2,$nombre,
			$a_paterno,$a_materno,$actividad_comp_clave_act, $rfc_inst));
	  	header('Location: instructor.php');
	}

	if(isset( $_GET['rfc_inst'] ) )
	{
		//TODO: GET DETAILS
		$show_form = TRUE;
		$sql_update = 'SELECT instructor.*, actividad_comp.nombre_act FROM instructor INNER JOIN actividad_comp
		ON actividad_comp.clave_act = instructor.actividad_comp_clave_act WHERE rfc_inst = ?';
		$rfc_inst = isset( $_GET['rfc_inst']) ? $_GET['rfc_inst'] : 0;

		$statement_update = $pdo->prepare($sql_update);
		$statement_update->execute(array($rfc_inst));
		$result_details = $statement_update->fetchAll();
		$rs_details = $result_details[0];

	}

  $sql_status = 'SELECT instructor.*, actividad_comp.nombre_act FROM instructor INNER JOIN actividad_comp
  ON actividad_comp.clave_act = instructor.actividad_comp_clave_act';
  $statement_status = $pdo->prepare($sql_status);
  $statement_status->execute();
  $results_status = $statement_status->fetchAll();
?>
<?php
	include('../extend/header.php');
?>

		<div class="container">
			<div class="row">
				<div class="col s12">
					<h2>Proyecto de actividades complementarias</h2>
					<hr>
					<?php
						if( $show_form )
						{
						?>
						<form method="post">
							<div class="row">
								<div class="input-field col s12">
          							<input placeholder='<?php echo $rs_details['rfc_inst'] ?>' name='rfc_inst_2' type="text">
        						</div>
							</div>
						   <div class="row">
        				<div class="input-field col s12">
        							<!--<i class="material-icons prefix">account_circle</i>-->
          							<input placeholder='<?php echo $rs_details['nombre'] ?>' name='nombre' type="text">
        						</div>
                  </div>
                    <div class="row">
        						<div class="input-field col s12">
        							<!--<i class="material-icons prefix">account_circle</i>-->
          							<input placeholder="<?php echo $rs_details['a_paterno'] ?>" name="a_paterno" type="text">
        						</div>
                  </div>
                    <div class="row">
        						<div class="input-field col s12">
        							<!--<i class="material-icons prefix">account_circle</i>-->
          						<input placeholder="<?php echo $rs_details['a_materno'] ?>" name="a_materno" type="text">
        						</div>
                  </div>
        					  <div class="row">
            				<div class="input-field col s12">
    									<select name="actividad_comp_clave_act">
    											<option value="" disabled selected>Elige el nombre de la actividad</option>
                      			<?php
    				        	foreach($results as $rs) {
    				        	?>
      							<option value="<?php echo $rs['clave_act']?>"><?php echo $rs['nombre_act']?> </option>
      							<?php
    				          	}
    				        ?>
    						</select>
              </div>
            </div>
        				<input class="btn waves-effect waves-light orange" type="submit" value="Modificar" />
						</form>
					<?php }
          ?>
          <h3>Instructor</h3>
        <hr>
        <table class="striped">
              <thead>
              <tr>
                  <th>RFC</th>
                      <th>Nombre</th>
                      <th>Apellido Paterno</th>
                      <th>Apellido Materno</th>
                      <th>Actividad complementaria</th>
                        <th colspan="2">Acción</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach($results_status as $rs) {
                ?>
                <tr>
            <td><?php echo $rs['rfc_inst']?></td>
            <td><?php echo $rs['nombre']?></td>
            <td><?php echo $rs['a_paterno']?></td>
            <td><?php echo $rs['a_materno']?></td>
            <td><?php echo $rs['actividad_comp_clave_act']?></td>

            <td><a class="btn waves-effect waves-light orange" href="instructor.php?rfc_inst=<?php
            echo $rs['rfc_inst']; ?>">Ver detalles</a></td>
						<td><a class="btn waves-effect waves-light red" onclick="delete_instructor('<?php echo $rs["rfc_inst"]; ?>')" href="#">ELIMINAR</a>
						</tr>
              <?php
                  }
                ?>
            </tbody>
          </table>
        </div>
      </div>
			<?php
				include('../extend/footer.php');
			?>
