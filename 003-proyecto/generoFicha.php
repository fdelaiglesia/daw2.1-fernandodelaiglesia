<?php
require_once "_varios.php";
session_start();
$pdo = conectarBD();


$id = (int)$_REQUEST["id"];

$nueva_entrada = ($id == -1);

if ($nueva_entrada) {
    $generoNombre = "";
} else {
    $sql = "SELECT genero FROM genero WHERE id=?";

    $select = $pdo->prepare($sql);
    $select->execute([$id]);
    $rs = $select->fetchAll();

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
