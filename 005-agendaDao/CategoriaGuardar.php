<?php
require_once "_com/DAO.php";

// Se recogen los datos del formulario de la request.
$id = (int)$_REQUEST["id"];
$nombre = $_REQUEST["nombre"];


$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) {
	$crear = DAO::categoriaCrear($nombre);
} else {
	$actualizar = DAO::categoriaActualizar($id, $nombre);
}

?>



<html>

<head>
	<meta charset='UTF-8'>
</head>



<body>
	<?php
	// Todo bien tanto si se han guardado los datos nuevos como si no se habían modificado.
	echo $crear;
	echo $actualizar;
	if ($crear > 0 || $actualizar > 0) { ?>
		<?php if ($nuevaEntrada) { ?>
			<h1>Inserción completada</h1>
			<p>Se ha insertado correctamente la nueva entrada de <?= $nombre ?>.</p>
		<?php } else { ?>
			<h1>Guardado completado</h1>
			<p>Se han guardado correctamente los datos de <?= $nombre ?>.</p>
		<?php }
		?>

	<?php
	} else {
	?>

		<?php if ($nuevaEntrada) { ?>
			<h1>Error en la creación.</h1>
			<p>No se ha podido crear la nueva categoría.</p>
		<?php } else { ?>
			<h1>Error en la modificación.</h1>
			<p>No se han podido guardar los datos de la categoría.</p>
		<?php } ?>

	<?php
	}
	?>

	<a href='CategoriaListado.php'>Volver al listado de categorías.</a>

</body>

</html>