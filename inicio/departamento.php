<?php
	require_once('../conexion/conexion.php');
	$title = 'Departamentos';
	$title_menu = 'Departamentos';

	// Consulta para mostrar los datos de la tabla "departamento"
  $sql_departamento = 'SELECT * FROM departamento';
	$statement_departamento= $pdo->prepare($sql_departamento);
	$statement_departamento->execute(array());
	$results_departamento=$statement_departamento->fetchAll();

	$show_form = FALSE;

	if($_POST)
	{
	  	//TODO:UPDATE ARTICLE
	  	$sql_update_details = 'UPDATE departamento SET rfc_dep = ?, nombre_dep = ?,
			trabajador_rfc = ? WHERE rfc_dep = ?';

			$rfc_dep = isset($_GET['rfc_dep']) ? $_GET['rfc_dep']: '';
			$rfc_dep_2 = isset($_POST['rfc_dep_2']) ? $_POST['rfc_dep_2']: '';
  		$nombre_dep = isset($_POST['nombre_dep']) ? $_POST['nombre_dep']: '';
  		$trabajador_rfc = isset($_POST['trabajador_rfc']) ? $_POST['trabajador_rfc']: '';

	  	$statement_update_details = $pdo->prepare($sql_update_details);
	  	$statement_update_details->execute(array($rfc_dep_2,$nombre_dep,
			$trabajador_rfc, $rfc_dep));
	  	header('Location: departamento.php');
	}

	if(isset( $_GET['rfc_dep'] ) )
	{
		//TODO: GET DETAILS
		$show_form = TRUE;
		$sql_update = 'SELECT trabajador.*, departamento.* FROM trabajador INNER JOIN departamento
  	ON trabajador.rfc_tra = departamento.trabajador_rfc WHERE rfc_dep = ?';
		$rfc_dep = isset( $_GET['rfc_dep']) ? $_GET['rfc_dep'] : 0;

		$statement_update = $pdo->prepare($sql_update);
		$statement_update->execute(array($rfc_dep));
		$result_details = $statement_update->fetchAll();
		$rs_details = $result_details[0];

	}

  $sql_status = 'SELECT trabajador.*, departamento.* FROM trabajador INNER JOIN departamento
	ON trabajador.rfc_tra = departamento.trabajador_rfc';
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
          							<input value='<?php echo $rs_details['rfc_dep'] ?>' name='rfc_dep_2' type="text">
        						</div>
							</div>
						   <div class="row">
        				<div class="input-field col s12">
        							<!--<i class="material-icons prefix">account_circle</i>-->
          							<input value='<?php echo $rs_details['nombre_dep'] ?>' name='nombre_dep' type="text">
        						</div>
                  </div>
                  <div class="row">
            				<div class="input-field col s12">
    									<select name="trabajador_rfc">
    											<option value="" disabled selected>Elige el nombre del trabajador</option>
                      			<?php
    				        	foreach($results_departamento as $rs) {
    				        	?>
      							<option value="<?php echo $rs['trabajador_rfc']?>"><?php echo $rs['trabajador_rfc']?> </option>
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
          <h3>Departamento</h3>
        <hr>
        <table class="striped">
              <thead>
              <tr>
                  <th>RFC Departamento</th>
                  <th>Nombre Departamento</th>
                  <th>RFC Trabajador</th>
                      <th colspan="2">Acción</th>
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
            <td><a class="btn waves-effect waves-light orange" href="departamento.php?rfc_dep=<?php
            echo $rs['rfc_dep']; ?>">Ver detalles</a></td>
						<td><a class="btn waves-effect waves-light red" onclick="delete_departamento('<?php echo $rs["rfc_dep"]; ?>')" href="#">ELIMINAR</a>
            </tr>
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
