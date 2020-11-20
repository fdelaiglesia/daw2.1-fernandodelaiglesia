<?php
require_once "_varios.php";
session_start();
$pdo = conectarBD();

// Se recoge el parámetro "id" de la request.
$id = (int)$_REQUEST["id"];

$sql = "DELETE FROM genero WHERE id=?";

$sentencia = $pdo->prepare($sql);
$sql_con_exito = $sentencia->execute([$id]);
$una_fila_afectada = ($sentencia->rowCount() == 1);
$ninguna_fila_afectada = ($sentencia->rowCount() == 0);

$correcto = ($sql_con_exito && $una_fila_afectada);

$no_existia = ($sql_con_exito && $ninguna_fila_afectada);
?>


<html>
<head>
    <meta charset="UTF-8">
    <?php require "partials/css.php"; ?>
</head>

<?php require "partials/navbar.php"; ?>

<div id="body">
    <?php if ($correcto) { ?>

        <h1>Eliminación completada</h1>
        <p>Se ha eliminado correctamente el genero.</p>

    <?php } else if ($no_existia) { ?>

        <h1>Eliminación imposible</h1>
        <p>No existe el genero que se pretende eliminar (¿ha manipulado Vd. el parámetro id?).</p>

    <?php } else { ?>

        <h1>Error en la eliminación</h1>
        <p>No se ha podido eliminar el genero.</p>

    <?php } ?>

    <a href="generoListado.php" class="btn btn-secondary">Volver al listado de generos.</a>
</div>
</body>

</html>
