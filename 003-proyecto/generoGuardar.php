<?php
require_once "_varios.php";
session_start();
$pdo = conectarBD();

$id = (int)$_REQUEST["id"];
$genero = $_REQUEST["genero"];


$nueva_entrada = ($id == -1);

if ($nueva_entrada) {
    $sql = "INSERT INTO genero (genero) VALUES (?)";
    $parametros = [$genero];
} else {
    $sql = "UPDATE genero SET genero=? WHERE id=?";
    $parametros = [$genero, $id];
}

$sentencia = $pdo->prepare($sql);
$sql_con_exito = $sentencia->execute($parametros);


$una_fila_afectada = ($sentencia->rowCount() == 1);
$ninguna_fila_afectada = ($sentencia->rowCount() == 0);


$correcto = ($sql_con_exito && $una_fila_afectada);


$datos_no_modificados = ($sql_con_exito && $ninguna_fila_afectada);
?>


<html>

<head>
    <meta charset="UTF-8">
    <?php require "partials/css.php"; ?>
</head>

<?php require "partials/navbar.php"; ?>

<body>
<div id="body">

    <?php
    if ($correcto || $datos_no_modificados) { ?>

        <?php if ($id == -1) { ?>
            <h1>Inserción completada</h1>
            <p>Se ha insertado correctamente la nueva entrada de <?php echo $genero; ?>.</p>
        <?php } else { ?>
            <h1>Guardado completado</h1>
            <p>Se han guardado correctamente los datos de <?php echo $genero; ?>.</p>

            <?php if ($datos_no_modificados) { ?>
                <p>En realidad, no había modificado nada, pero no está de más que se haya asegurado pulsando el botón de
                    guardar :)</p>
            <?php } ?>
        <?php }
        ?>

        <?php
    } else {
        ?>

        <h1>Error en la modificación.</h1>
        <p>No se han podido guardar los datos del genero.</p>

        <?php
    }
    ?>

    <a href="generoListado.php" class="btn btn-secondary">Volver al listado de generos</a>

</div>
</body>

</html>
