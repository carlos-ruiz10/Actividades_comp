<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" href="../css/materialize.min.css">
        <script>
            function delete_estudiante(id_to_delete)
            {
                var confirmation = confirm('¿Está seguro de que desea eliminar el estudiante con el número de control '+ id_to_delete);
    
                if(confirmation)
                {
                    window.location = "delete_estudiante.php?n_control="+id_to_delete;
                }
            }
        </script>

        <script>
            function delete_carrera(id_to_delete)
            {
                var confirmation = confirm('¿Está seguro de que desea eliminar la carrera con la clave'+ id_to_delete);
                if(confirmation)
                {
                    window.location = "delete_carrera.php?clave_carrera="+id_to_delete;
                }
            }
        </script>

        <script>
            function delete_actividades(id_to_delete)
            {
                var confirmation = confirm('¿Está seguro de que desea eliminar la actividad con la clave '+ id_to_delete);
    
                if(confirmation)
                {
                    window.location = "delete_actividades.php?clave_act="+id_to_delete;
                }
            }
        </script>

        <script>
            function delete_departamento(id_to_delete)
            {
                var confirmation = confirm('¿Está seguro de que desea eliminar el departamento con clave '+ id_to_delete);
    
                if(confirmation)
                {
                    window.location = "delete_departamento.php?rfc_dep="+id_to_delete;
                }
            }
        </script>

        <script>
            function delete_instituto(id_to_delete)
            {
                var confirmation = confirm('¿Está seguro de que desea eliminar el instituto con la clave '+ id_to_delete);
    
                if(confirmation)
                {
                    window.location = "delete_instituto.php?clave="+id_to_delete;
                }
            }
        </script>

        <script>
            function delete_instructor(id_to_delete)
            {
                var confirmation = confirm('¿Está seguro de que desea eliminar el instructor con RFC '+ id_to_delete);
    
                if(confirmation)
                {
                    window.location = "delete_instructor.php?rfc_inst="+id_to_delete;
                }
            }
        </script>

        <script>
            function delete_solicitud(id_to_delete)
            {
                var confirmation = confirm('¿Está seguro de que desea eliminar la solicitud con folio '+ id_to_delete);
    
                if(confirmation)
                {
                    window.location = "delete_solicitud.php?folio="+id_to_delete;
                }
            }
        </script>

        <script>
            function delete_trabajador(id_to_delete)
            {
                var confirmation = confirm('¿Está seguro de que desea eliminar el trabajador con RFC '+ id_to_delete);
    
                if(confirmation)
                {
                    window.location = "delete_trabajador.php?rfc_tra="+id_to_delete;
                }
            }
        </script>

		</head>

	<body>
		<!--Import jQuery before materialize.js-->
    	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    	<script type="text/javascript" src="../js/materialize.min.js"></script>
    	<div class="navbar-fixed">
            <nav class="red accent-4">
                <div class="nav-wrapper">
                    <a href="#" class="brand-logo right"><?php echo $title_menu; ?></a>
                    <ul id="nav-mobile" class="left side-nav">
                        <li><a href="index.php">Inicio</a></li>
                    </ul>
                </div>
            </nav>
        </div>