<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	require_once "_com/DAO.php";
$persona =false;
$personaModificar = false;
	
	$id = (int)$_REQUEST["id"];
	$nombre = $_REQUEST["nombre"];
	$apellidos = $_REQUEST["apellidos"];
	$telefono = $_REQUEST["telefono"];
    $categoriaId = (int)$_REQUEST["categoriaId"];
    $estrella = isset($_REQUEST["estrella"]);

	// Si id es -1 quieren INSERTAR una nueva entrada ($nueva_entrada tomará true).
	// Sin embargo, si id NO es -1 quieren ACTUALIZAR la ficha de una persona existente
	// (y $nueva_entrada tomar false).
	$nuevaEntrada = ($id == -1);
	
	if ($nuevaEntrada) {
		// Quieren CREAR una nueva entrada, así que es un INSERT.
 		$persona = DAO::personaCrear($nombre,$apellidos,$telefono,$estrella,$categoriaId);
	} else {
		// Quieren MODIFICAR una persona existente y es un UPDATE.
 		$personaModificar = DAO::personaActualizar($id,$nombre,$apellidos,$telefono,$estrella,$categoriaId);
 	}


?>



<html>

<head>
	<meta charset='UTF-8'>
</head>



<body>

<?php
	// Todo bien tanto si se han guardado los datos nuevos como si no se habían modificado.
	if ($personaModificar || $persona) { ?>

		<?php if ($id == -1) { ?>
			<h1>Inserción completada</h1>
			<p>Se ha insertado correctamente la nueva entrada de <?php echo $nombre; ?>.</p>
		<?php } else { ?>
			<h1>Guardado completado</h1>
			<p>Se han guardado correctamente los datos de <?php echo $nombre; ?>.</p>

			<?php if ($datosNoModificados) { ?>
				<p>En realidad, no había modificado nada, pero no está de más que se haya asegurado pulsando el botón de guardar :)</p>
			<?php } ?>
		<?php }
?>

<?php
	} else {
?>

	<h1>Error en la modificación.</h1>
	<p>No se han podido guardar los datos de la persona.</p>

<?php
	}
?>

<a href='PersonaListado.php'>Volver al listado de personas.</a>

</body>

</html>