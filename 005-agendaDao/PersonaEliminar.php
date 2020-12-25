<?php
	require_once "_com/DAO.php";

	$id = (int)$_REQUEST["id"];

	$eliminar = DAO::personaEliminar($id);


?>
<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<?php if ($eliminar) { ?>

	<h1>Eliminación completada</h1>
	<p>Se ha eliminado correctamente la persona.</p>

<?php } else { ?>

	<h1>Eliminación imposible</h1>
	<p>No existe la persona que se pretende eliminar (¿ha manipulado Vd. el parámetro id?).</p>

<?php }  ?>

	
<a href='PersonaListado.php'>Volver al listado de personas.</a>

</body>

</html>