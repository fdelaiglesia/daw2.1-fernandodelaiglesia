<?php
	require_once "_varios.php";

	$pdo = obtenerPdoConexionBD();
	
	$sql = "SELECT id, nombre FROM categoria ORDER BY nombre";

    $select = $pdo->prepare($sql);
    $select->execute([]); // Array vacío porque la consulta preparada no requiere parámetros.
    $rs = $select->fetchAll();
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
<h1>Listado de Categorías</h1>

<table class="table table-striped table-hover">

	<tr>
		<th>Nombre</th>
        <th>Eliminar</th>
	</tr>

	<?php
        foreach ($rs as $fila) { ?>
			<tr>
				<td><a href=   "categoria-ficha.php?id=<?=$fila["id"]?>"> <?=$fila["nombre"] ?> </a></td>
				<td><a href="categoria-eliminar.php?id=<?=$fila["id"]?>"> <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
</svg>                   </a></td>
			</tr>
	<?php } ?>

</table>

<br />

<a href="categoria-ficha.php?id=-1" class="btn btn-primary">Crear entrada</a>



<a href="persona-listado.php" class="btn btn-primary">Gestionar listado de Personas</a>
</div>
</body>

</html>
