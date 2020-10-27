<?php

    require_once "_varios.php";
	$sql = "
           SELECT
                p.id     AS p_id,
                p.nombre AS p_nombre,
                c.id     AS c_id,
                c.nombre AS c_nombre
            FROM
               persona AS p INNER JOIN categoria AS c
               ON p.categoria_id = c.id
            ORDER BY p.nombre
    ";
    $pdo = obtenerPdoConexionBD();
    $select = $pdo->prepare($sql);
    $select->execute([]);
    $personas = $select->fetchAll();
    ?>



<html>

<head>
	<meta charset="UTF-8">
</head>



<body>

<h1>Listado de Personas</h1>

<table border="1">

	<tr>
		<th>Nombre</th>
        <th>Categoria</th>
	</tr>

	<?php
        foreach ($personas as $fila) { ?>
			<tr>
				<td><a href= "persona-ficha.php?id=<?=$fila["p_id"]?>"> <?=$fila["p_nombre"] ?> </a></td>
                <td><a href= "categoria-ficha.php?id=<?=$fila["c_id"]?>"> <?=$fila["c_nombre"] ?> </a></td>
				<td><a href="persona-eliminar.php?id=<?=$fila["p_id"]?>"> (X)                   </a></td>
			</tr>
	<?php } ?>

</table>

<br />

<a href="persona-ficha.php">Añadir una persona</a>

<br />
<br />

<a href="categoria-listado.php">Gestionar listado de Categorias</a>

</body>

</html>