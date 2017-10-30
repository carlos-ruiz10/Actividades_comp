<?php
	require_once('../conexion/conexion.php');
	$title = 'Solicitudes';
	$title_menu = 'Solicitudes';

  $sql_solicitud = 'SELECT * FROM solicitud';
	$statement_solicitud= $pdo->prepare($sql_solicitud);
	$statement_solicitud->execute(array());
	$results_solicitud=$statement_solicitud->fetchAll();

	$show_form = FALSE;

	if($_POST)
	{
	  	//TODO:UPDATE ARTICLE
	  	$sql_update_details = 'UPDATE solicitud SET folio = ?, asunto = ?,
			fecha = ?, actividad_comp_clave_act = ?, instituto_clave = ?, trabajador_rfc = ?, estudiante_n_control = ?
			WHERE folio = ?';

		  $folio = isset($_GET['folio']) ? $_GET['folio']: '';
		  $folio_2 = isset($_POST['folio_2']) ? $_POST['folio_2']: '';
  		$asunto = isset($_POST['asunto']) ? $_POST['asunto']: '';
  		$fecha = isset($_POST['fecha']) ? $_POST['fecha']: '';
  		$actividad_comp_clave_act = isset($_POST['actividad_comp_clave_act']) ? $_POST['actividad_comp_clave_act']: '';
  		$instituto_clave = isset($_POST['instituto_clave']) ? $_POST['instituto_clave']: '';
  		$trabajador_rfc = isset($_POST['trabajador_rfc']) ? $_POST['trabajador_rfc']: '';
      $estudiante_n_control = isset($_POST['estudiante_n_control']) ? $_POST['estudiante_n_control']: '';

	  	$statement_update_details = $pdo->prepare($sql_update_details);
	  	$statement_update_details->execute(array($folio_2, $asunto,
			$fecha,$actividad_comp_clave_act,$instituto_clave,$trabajador_rfc,$estudiante_n_control,$folio ));
	  	header('Location: solicitud.php');
	}

	if(isset( $_GET['folio'] ) )
	{
		//TODO: GET DETAILS
		$show_form = TRUE;
		$sql_update = 'SELECT solicitud.*, instituto.nombre, trabajador.nombre_tra, estudiante.nombre_estudiante FROM solicitud
  	INNER JOIN instituto ON instituto.clave = solicitud.instituto_clave INNER JOIN trabajador ON trabajador.rfc_tra = solicitud.trabajador_rfc
  	INNER JOIN estudiante ON estudiante.n_control = solicitud.estudiante_n_control WHERE folio = ?';
		$folio = isset( $_GET['folio']) ? $_GET['folio'] : 0;

		$statement_update = $pdo->prepare($sql_update);
		$statement_update->execute(array($folio));
		$result_details = $statement_update->fetchAll();
		$rs_details = $results_solicitud[0];

	}

	$sql_status = 'SELECT solicitud.*, instituto.nombre, trabajador.nombre_tra, estudiante.nombre_estudiante FROM solicitud
	INNER JOIN instituto ON instituto.clave = solicitud.instituto_clave INNER JOIN trabajador ON trabajador.rfc_tra = solicitud.trabajador_rfc
	INNER JOIN estudiante ON estudiante.n_control = solicitud.estudiante_n_control';
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
          							<input value='<?php echo $rs_details['folio'] ?>' name='folio_2' type="text">
        						</div>
							</div>
							<div class="row">
        						<div class="input-field col s12">
        							<!--<i class="material-icons prefix">account_circle</i>-->
          							<input value='<?php echo $rs_details['asunto'] ?>' name='asunto' type="text">
        						</div>
        						<div class="input-field col s12">
        							<!--<i class="material-icons prefix">account_circle</i>-->
          							<input value="<?php echo $rs_details['fecha'] ?>" name="fecha" type="text">
        						</div>
        						<div class="input-field col s12">
        							<!--<i class="material-icons prefix">account_circle</i>-->
          						<input value="<?php echo $rs_details['actividad_comp_clave_act'] ?>" name="actividad_comp_clave_act" type="text">
        						</div>
        					</div>
        					<div class="row">
        						<div class="input-field col s12">
    								<select name="instituto_clave">
			      						<option value="" disabled selected>Elige la clave del instituto</option>
                        <?php
                        foreach($results_solicitud as $rs){
                         ?>
                         <option value="<?php echo $rs['instituto_clave']?>"><?php echo $rs['instituto_clave']?></option>
                         	<?php
   				          					}
   				        				?>
                        </select>
                      </div>
                      </div>
                      <div class="row">
            						<div class="input-field col s12">
        								<select name="trabajador_rfc">
    			      						<option value="" disabled selected>Elige el rfc del trabajador</option>
                            <?php
                            foreach($results_solicitud as $rs){
                             ?>
                             <option value="<?php echo $rs['trabajador_rfc']?>"><?php echo $rs['trabajador_rfc']?></option>
                             	<?php
       				          					}
       				        				?>
                            </select>
                          </div>
                          </div>
                          <div class="row">
                						<div class="input-field col s12">
            								<select name="estudiante_n_control">
        			      						<option value="" disabled selected>Elige el numero de control del estudiante</option>
                                <?php
                                foreach($results_solicitud as $rs){
                                 ?>
                                 <option value="<?php echo $rs['estudiante_n_control']?>"><?php echo $rs['estudiante_n_control']?></option>
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
				    <h3>Solicitud</h3>
				    <table class="striped">
					  <thead>
					    <tr>
                <th>Folio</th>
                <th>Asunto</th>
                <th>Fecha</th>
                <th>Actividad</th>
                <th>Instituto Clave</th>
                <th>Trabajador RFC</th>
                <th>No Control Estudiante</th>
				        <th colspan="2">Acción</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php
				        	foreach($results_solicitud as $rs2) {
				        ?>
					    <tr>
					    	<td><?php echo $rs2['folio']?></td>
							<td><?php echo $rs2['asunto']?></td>
							<td><?php echo $rs2['fecha']?></td>
							<td><?php echo $rs2['actividad_comp_clave_act']?></td>
							<td><?php echo $rs2['instituto_clave']?></td>
							<td><?php echo $rs2['trabajador_rfc']?></td>
							<td><?php echo $rs2['estudiante_n_control']?></td>

							<td><a class="btn waves-effect waves-light orange" href="solicitud.php?folio=<?php echo $rs2['folio']; ?>">Ver detalles</a></td>
							
							<td><a class="btn waves-effect waves-light red" onclick="delete_solicitud(<?php echo $rs2['folio']; ?>)" href="#">ELIMINAR</a>
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
