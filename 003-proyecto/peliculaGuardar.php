<?php
require_once "_varios.php";
$pdo =conectarBD();

$id = (int)$_REQUEST["id"];
$titulo = $_REQUEST["titulo"];
$anyo = $_REQUEST["anyo"];
$director = $_REQUEST["director"];
$valoracion = $_REQUEST["valoracion"];
$portada = $_REQUEST["portada"];

$nueva_entrada = ($id == -1);

if ($nueva_entrada) {
    $sql = "INSERT INTO pelicula (titulo,anyo,director,valoracion,portada) VALUES (?,?,?,?,?)";
    $parametros = [$titulo, $anyo ,$director, $valoracion, $portada ];
} else {
    $sql = "UPDATE pelicula SET titulo=?, anyo=?, director=?, valoracion=?,portada=? WHERE id=?";
    $parametros = [$titulo,$anyo, $director, $valoracion,$portada, $id];
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
   <link rel="stylesheet" href="css.css">
</head>


<body>

    <?php
    if ($correcto || $datos_no_modificados) { ?>

        <?php if ($id == -1) { ?>
            <h1>Inserción completada</h1>
            <p>Se ha insertado correctamente la nueva entrada de <?php echo $titulo; ?>.</p>
        <?php } else { ?>
            <h1>Guardado completado</h1>
            <p>Se han guardado correctamente los datos de <?php echo $titulo; ?>.</p>

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
        <p>No se han podido guardar los datos de la peliculas.</p>

        <?php
    }
    ?>

    <a href="peliculaListado.php">Volver al listado de peliculas.</a>

</body>

</html>
