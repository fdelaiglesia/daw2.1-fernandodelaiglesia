<?php
session_start();

require_once "_varios.php";
$clausulaWhere = "";
//Clausula que sirve para buscar peliculas
if (isset($_REQUEST["buscar"]) && !empty($_REQUEST["busqueda"])) {
    $busqueda = $_REQUEST["busqueda"];
    $clausulaWhere = "WHERE p.titulo LIKE '%" . $busqueda . "%'";
    $botonBusqueda = '<a href="peliculaListado.php"  class="btn btn-secondary">Volver al listado</a>';
} else {
    $botonBusqueda = '';
}

//Variable para comprobar que el usuario es el administrador del sitio
$admin = ($_SESSION['usuario'] == 'admin');

if ($_SESSION['usuario'] == null) {
    redireccionar("login.php");
}
$sql = "
           SELECT
                p.id     AS p_id,
                p.titulo AS p_titulo,
                p.director AS p_director,
                p.anyo AS p_anyo,
                p.valoracion AS p_valoracion
            FROM pelicula AS p
            $clausulaWhere
    ";
$pdo = conectarBD();
$select = $pdo->prepare($sql);
$select->execute([]);
$peliculas = $select->fetchAll();

?>


<head>
    <meta charset="utf-8">
    <title>Videoclub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require 'partials/css.php' ?>

</head>
<body>
<?php require 'partials/navbar.php' ?>

<!--Inicio de html/php-->
<div id="body">
    <h1>Listado de Peliculas</h1>
    <form action="peliculaListado.php" method="post">
        <input type="text" name="busqueda" placeholder="Pelicula.." class="busqueda">
        <input type="submit" name="buscar" class="btn btn-secondary" value="Buscar pelicula">
        <?= $botonBusqueda ?>
    </form>
    <table class="table table-striped table-hover">

        <tr>
            <th>Titulo</th>
            <th>Año</th>
            <th>Director</th>
            <th>Valoracion</th>
            <?php if ($admin) { ?>
                <th>Eliminar</th>
            <?php } ?>
        </tr>
        <?php
        foreach ($peliculas as $fila) { ?>
            <tr>
                <td><a href="peliculaFicha.php?id=<?= $fila["p_id"] ?>"> <?= $fila["p_titulo"] ?> </a></td>
                <td> <?= $fila["p_anyo"] ?> </td>
                <td> <?= $fila["p_director"] ?> </td>
                <td><?= $fila["p_valoracion"] ?></td>
                <?php if ($admin) { ?>
                    <td><a href="peliculaEliminar.php?id=<?= $fila["p_id"] ?>"><img src="assets/img/delete.png"
                                                                                    width="20" height="20"></a></td>
                <?php } ?>
            </tr>
        <?php } ?>

    </table>
    <hr>
    <?php if ($admin) { ?>
        <a href="peliculaFicha.php?id=-1" class="btn btn-secondary">Añadir una pelicula</a>
        <a href="generoListado.php" class="btn btn-secondary">Gestionar listado de generos</a>

    <?php } ?>

</div>
</body>
</html>

