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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css.css">
</head>


<body>
<nav class="navbar navbar-dark bg-primary">
    <a id="agenda" class="navbar-brand">Agenda</a>
</nav>
<div id="body">
    <h1>Listado de Personas</h1>

    <table class="table table-striped table-hover">

        <tr>
            <th>Nombre</th>
            <th>Categoria</th>
            <th>Eliminar</th>
        </tr>

        <?php
        foreach ($personas as $filaUnica) { ?>
            <tr>
                <td><a href="persona-ficha.php?id=<?= $filaUnica["p_id"] ?>"> <?= $filaUnica["p_nombre"] ?> </a></td>
                <td><a href="categoria-ficha.php?id=<?= $filaUnica["c_id"] ?>"> <?= $filaUnica["c_nombre"] ?> </a></td>
                <td><a href="persona-eliminar.php?id=<?= $filaUnica["p_id"] ?>">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle-fill"
                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                        </svg>
                    </a></td>
            </tr>
        <?php } ?>

    </table>

    <br/>

    <a href="persona-ficha.php?id=-1" class="btn btn-primary">Añadir una persona</a>


    <a href="categoria-listado.php" class="btn btn-primary">Gestionar listado de Categorias</a>
</div>
</body>

</html>
