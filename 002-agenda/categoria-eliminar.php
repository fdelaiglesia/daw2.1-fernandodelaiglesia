<?php
	require_once "_varios.php";

	$pdo = obtenerPdoConexionBD();

	// Se recoge el parámetro "id" de la request.
	$id = (int)$_REQUEST["id"];

	$sql = "DELETE FROM categoria WHERE id=?";

    $sentencia = $pdo->prepare($sql);
    //Esta llamada devuelve true o false según si la ejecución de la sentencia ha ido bien o mal.
    $sql_con_exito = $sentencia->execute([$id]); // Se añade el parámetro a la consulta preparada.

    //Se consulta la cantidad de filas afectadas por la ultima sentencia sql.
    $una_fila_afectada = ($sentencia->rowCount() == 1);
    $ninguna_fila_afectada = ($sentencia->rowCount() == 0);

    // Está todo correcto de forma normal si NO ha habido errores y se ha visto afectada UNA fila.
    $correcto = ($sql_con_exito && $una_fila_afectada);

 	// Caso raro: no había un caso con ese id...
 	$no_existia = ($sql_con_exito && $ninguna_fila_afectada);
?>



<html>

<head>
	<meta charset="UTF-8">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css.css">
</head>



<body>
<nav class="navbar navbar-dark bg-primary">
    <a class="navbar-brand">Agenda</a>
</nav>
<div id="body">
<?php if ($correcto) { ?>

	<h1>Eliminación completada</h1>
	<p>Se ha eliminado correctamente la categoría.</p>

<?php } else if ($no_existia) { ?>

	<h1>Eliminación imposible</h1>
	<p>No existe la categoría que se pretende eliminar (¿ha manipulado Vd. el parámetro id?).</p>

<?php } else { ?>

	<h1>Error en la eliminación</h1>
	<p>No se ha podido eliminar la categoría o la categoría no existía.</p>

<?php } ?>

<a href="categoria-listado.php" class="btn btn-primary">Volver al listado de categorías.</a>
</div>
</body>

</html>
