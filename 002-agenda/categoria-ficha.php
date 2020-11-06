<?php
require_once "_varios.php";

$pdo = obtenerPdoConexionBD();

// Se recoge el parámetro "id" de la request.
$id = (int)$_REQUEST["id"];

// Si id es -1 quieren CREAR una nueva entrada ($nueva_entrada tomará true).
// Sin embargo, si id NO es -1 quieren VER la ficha de una categoría existente
// (y $nueva_entrada tomará false).
$nueva_entrada = ($id == -1);

if ($nueva_entrada) { // Quieren CREAR una nueva entrada, así que no se cargan datos.
    $categoria_nombre = "";
} else { // Quieren VER la ficha de una categoría existente, cuyos datos se cargan.
    $sql = "SELECT nombre FROM categoria WHERE id=?";

    $select = $pdo->prepare($sql);
    $select->execute([$id]); // Se añade el parámetro a la consulta preparada.
    $rs = $select->fetchAll();

    // Con esto, accedemos a los datos de la primera (y esperemos que única) fila que haya venido.
    $categoria_nombre = $rs[0]["nombre"];
}
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
    <a class="navbar-brand">Agenda</a>
</nav>
<div id="body">
    <?php if ($nueva_entrada) { ?>
        <h1>Nueva ficha de categoría</h1>
    <?php } else { ?>
        <h1>Ficha de categoría</h1>
    <?php } ?>

    <form method="post" action="categoria-guardar.php">

        <input type="hidden" name="id" value="<?= $id ?>"/>

        <ul class="list-group">
            <li class="list-group-item list-group-item-action">
                <strong>Nombre: </strong>
                <input type="text" <?php if ($nueva_entrada) {
                    echo 'placeholder = "Categoria"';
                } ?> name="nombre" value="<?= $categoria_nombre ?>"/>
            </li>
        </ul>

        <?php if ($nueva_entrada) { ?>
            <input type="submit" name="crear" value="Crear categoría" class="btn btn-primary"/>
        <?php } else { ?>
            <input type="submit" name="guardar" value="Guardar cambios" class="btn btn-primary"/>
        <?php } ?>

    </form>


    <a href="categoria-eliminar.php?id=<?= $id ?>" class="btn btn-primary">Eliminar categoría</a>


    <a href="categoria-listado.php" class="btn btn-primary">Volver al listado de categorías.</a>
</div>
</body>

</html>
