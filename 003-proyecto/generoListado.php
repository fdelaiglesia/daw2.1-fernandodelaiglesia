<?php
require_once "_varios.php";
session_start();
$pdo = conectarBD();

$sql = "SELECT * FROM genero";

$select = $pdo->prepare($sql);
$select->execute([]); // Array vacío porque la consulta preparada no requiere parámetros.
$rs = $select->fetchAll();
?>


    <html>

<head>
    <meta charset="UTF-8">
    <?php require "partials/css.php"; ?>
</head>

<?php require "partials/navbar.php"; ?>

<div id="body">
    <h1>Listado de Generos</h1>

    <table class="table table-striped table-hover">

        <tr>
            <th>Nombre</th>
            <th>Eliminar</th>
        </tr>

        <?php
        foreach ($rs as $fila) { ?>
            <tr>
                <td><a href="generoFicha.php?id=<?= $fila["id"] ?>"> <?= $fila["genero"] ?> </a></td>
                <td><a href="generoEliminar.php?id=<?= $fila["id"] ?>"><img src="assets/img/delete.png" width="20" height="20"></a></td>
            </tr>
        <?php } ?>

    </table>

    <br/>

    <a href="generoFicha.php?id=-1" class="btn btn-secondary">Crear genero</a>


    <a href="peliculaListado.php" class="btn btn-secondary">Gestionar listado de peliculas</a>
</div>
</body>

    </html><?php
