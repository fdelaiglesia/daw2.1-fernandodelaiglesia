<?php
require_once "_varios.php";
session_start();
$pdo = conectarBD();

// Se recoge el parámetro "id" de la request.
$id = (int)$_REQUEST["id"];

// Si id es -1 quieren CREAR una nueva entrada ($nueva_entrada tomará true).
// Sin embargo, si id NO es -1 quieren VER la ficha de una categoría existente
// (y $nueva_entrada tomará false).
$nueva_entrada = ($id == -1);

if ($nueva_entrada) { // Quieren CREAR una nueva entrada, así que no se cargan datos.
    $generoNombre = "";
} else { // Quieren VER la ficha de una categoría existente, cuyos datos se cargan.
    $sql = "SELECT genero FROM genero WHERE id=?";

    $select = $pdo->prepare($sql);
    $select->execute([$id]); // Se añade el parámetro a la consulta preparada.
    $rs = $select->fetchAll();

    // Con esto, accedemos a los datos de la primera (y esperemos que única) fila que haya venido.
    $generoNombre= $rs[0]["genero"];
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <?php require "partials/css.php"; ?>
</head>

<?php require "partials/navbar.php"; ?>

<div id="body">
    <?php if ($nueva_entrada) { ?>
        <h1>Nueva ficha de genero</h1>
    <?php } else { ?>
        <h1>Ficha de <?=$generoNombre?></h1>
    <?php } ?>

    <form method="post" action="generoGuardar.php">

        <input type="hidden" name="id" value="<?= $id ?>"/>


                <strong>Nombre: </strong>
                <input type="text" <?php if ($nueva_entrada) {
                    echo 'placeholder = "Genero"';
                } ?> name="genero" value="<?=$generoNombre ?>"/>
            </li>
        </ul>

        <?php if ($nueva_entrada) { ?>
            <input type="submit" name="crear" value="Crear genero" class="btn btn-secondary"/>
        <?php } else { ?>
            <input type="submit" name="guardar" value="Guardar cambios" class="btn btn-secondary"/>
        <?php } ?>

    </form>


    <a href="generoEliminar.php?id=<?= $id ?>" class="btn btn-danger">Eliminar genero</a>


    <a href="generoListado.php" class="btn btn-secondary">Volver al listado de generos</a>
</div>
</body>

</html>
