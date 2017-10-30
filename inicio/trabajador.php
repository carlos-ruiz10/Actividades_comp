<?php
	require_once('../conexion/conexion.php');
	$title = 'Trabajadores';
	$title_menu = 'Trabajadores';


  $sql_trabajador = 'SELECT * FROM trabajador';
	$statement_trabajador= $pdo->prepare($sql_trabajador);
	$statement_trabajador->execute(array());
	$results_trabajador=$statement_trabajador->fetchAll();

	$show_form = FALSE;

	if($_POST)
	{
	  	//TODO:UPDATE ARTICLE
	  	$sql_update_details = 'UPDATE trabajador SET rfc_tra = ?, nombre_tra = ?,
			a_paterno_tra = ?, a_materno_tra = ?, clave_presupuestal= ?
			WHERE rfc_tra = ?';

			$rfc_tra = isset($_GET['rfc_tra']) ? $_GET['rfc_tra']: '';
			$rfc_tra_2 = isset($_POST['rfc_tra_2']) ? $_POST['rfc_tra_2']: '';
  		$nombre_tra = isset($_POST['nombre_tra']) ? $_POST['nombre_tra']: '';
  		$a_paterno_tra = isset($_POST['a_paterno_tra']) ? $_POST['a_paterno_tra']: '';
  		$a_materno_tra = isset($_POST['a_materno_tra']) ? $_POST['a_materno_tra']: '';
  		$clave_presupuestal = isset($_POST['clave_presupuestal']) ? $_POST['clave_presupuestal']: '';

	  	$statement_update_details = $pdo->prepare($sql_update_details);
	  	$statement_update_details->execute(array($rfc_tra_2,$nombre_tra,
			$a_paterno_tra,$a_materno_tra,$clave_presupuestal, $rfc_tra));
	  	header('Location: trabajador.php');
	}

	if(isset( $_GET['rfc_tra'] ) )
	{
		//TODO: GET DETAILS
		$show_form = TRUE;
		$sql_update = 'SELECT trabajador.*, departamento.* FROM trabajador INNER JOIN departamento
    ON trabajador.rfc_tra = departamento.trabajador_rfc WHERE rfc_tra = ?';
		$rfc_tra = isset( $_GET['rfc_tra']) ? $_GET['rfc_tra'] : 0;

    $statement_trabajador = $pdo->prepare($sql_trabajador);
    $statement_trabajador->execute();
    $results_status = $statement_trabajador->fetchAll();
		$rs_details = $results_trabajador[0];

	}

  $sql_status = 'SELECT trabajador.*, departamento.* FROM trabajador INNER JOIN departamento
  ON trabajador.rfc_tra = departamento.trabajador_rfc';
  $statement_status = $pdo->prepare($sql_status);
  $statement_status->execute();
  $results = $statement_status->fetchAll();
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
          							<input placeholder='<?php echo $rs_details['rfc_tra'] ?>' name='rfc_tra_2' type="text">
        						</div>
							</div>
						   <div class="row">
        				<div class="input-field col s12">
        							<!--<i class="material-icons prefix">account_circle</i>-->
          							<input placeholder='<?php echo $rs_details['nombre_tra'] ?>' name='nombre_tra' type="text">
        						</div>
                  </div>
                    <div class="row">
        						<div class="input-field col s12">
        							<!--<i class="material-icons prefix">account_circle</i>-->
          							<input placeholder="<?php echo $rs_details['a_paterno_tra'] ?>" name="a_paterno_tra" type="text">
        						</div>
                  </div>
                    <div class="row">
        						<div class="input-field col s12">
        							<!--<i class="material-icons prefix">account_circle</i>-->
          						<input placeholder="<?php echo $rs_details['a_materno_tra'] ?>" name="a_materno_tra" type="text">
        						</div>
                  </div>
                  <div class="row">
                  <div class="input-field col s12">
                    <!--<i class="material-icons prefix">account_circle</i>-->
                    <input placeholder="<?php echo $rs_details['clave_presupuestal'] ?>" name="clave_presupuestal" type="text">
                  </div>
                </div>
        				<input class="btn waves-effect waves-light orange" type="submit" value="Modificar" />
						</form>
					<?php }
          ?>
          <h3>Trabajador</h3>
        <hr>
        <table class="striped">
              <thead>
              <tr>
                  <th>RFC</th>
                      <th>Nombre</th>
                      <th>Apellido Paterno</th>
                      <th>Apellido Materno</th>
                      <th>clave Presupuestal</th>
                      <th colspan="2">Acción</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach($results_trabajador as $rs) {
                ?>
                <tr>
            <td><?php echo $rs['rfc_tra']?></td>
            <td><?php echo $rs['nombre_tra']?></td>
            <td><?php echo $rs['a_paterno_tra']?></td>
            <td><?php echo $rs['a_materno_tra']?></td>
            <td><?php echo $rs['clave_presupuestal']?></td>

            <td><a class="btn waves-effect waves-light orange" href="trabajador.php?rfc_tra=<?php
            echo $rs['rfc_tra']; ?>">Ver detalles</a></td>

						<td><a class="btn waves-effect waves-light red" onclick="delete_trabajador('<?php echo $rs["rfc_tra"]; ?>')" href="#">ELIMINAR</a>
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
