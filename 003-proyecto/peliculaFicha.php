<?php
require_once "_varios.php";
$pdo = conectarBD();
session_start();
$id = (int)$_REQUEST["id"];
$admin = ($_SESSION['usuario'] == 'admin');
$nueva_entrada = ($id == -1);
if($_SESSION['usuario'] == null){
    redireccionar("login.php");
}
if ($nueva_entrada) {
    $peliculaTitulo = "";
    $peliculaAnyo = "";
    $peliculaDirector = "";
    $peliculaValoracion = "";
    $peliculaLinkPortada = "";
    $peliculaGenero= "";
} else {
    $sqlPelicula = "SELECT * FROM pelicula  WHERE id=? ";

    $selectPelicula = $pdo->prepare($sqlPelicula);
    $selectPelicula->execute([$id]);
    $pelicula = $selectPelicula->fetchAll();

    $peliculaTitulo = $pelicula[0]["titulo"];
    $peliculaAnyo = $pelicula[0]["anyo"];
    $peliculaDirector = $pelicula[0]["director"];
    $peliculaValoracion = $pelicula[0]["valoracion"];
    $peliculaGenero = $pelicula[0]["genero"];
    $peliculaLinkPortada = $pelicula[0]["portada"];
}
$sqlGenero = "SELECT * FROM genero";
$selectGenero = $pdo->prepare($sqlGenero);
$selectGenero->execute([]);
$genero = $selectGenero->fetchAll();


?>
<head>
    <meta charset="utf-8">
    <title><?= $peliculaTitulo ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require 'partials/css.php' ?>

</head>
<body>
<?php require 'partials/navbar.php' ?>

<!--Inicio de html/php-->
<div id="body">
    <?php if (!$nueva_entrada) { ?>
        <h1>Ficha de <?= $peliculaTitulo ?></h1>

        <img src="<?= $peliculaLinkPortada ?>" width="300" height="500">
    <?php } else { ?>
        <h1>Nueva pelicula</h1>
        <img src="assets/img/default.png" width="300" height="500">
    <?php } ?>
    <form class="formFicha" method="post" action="peliculaGuardar.php">

        <input type="hidden" name="id" value="<?= $id ?>"/>

        <strong>Titulo: </strong>

        <?php if ($admin) { ?>
            <input type="text" name="titulo" <?php if ($nueva_entrada) {
                echo 'placeholder = "Titulo"';
            } ?> value="<?= $peliculaTitulo ?>"/>
        <?php } else {
            echo '<p>' . $peliculaTitulo . '</p>';
        } ?>
        <hr>

        <strong>Año: </strong>
        <?php if ($admin) { ?>
            <input type="number" min="1895" max="2025" name="anyo" <?php if ($nueva_entrada) {
                echo 'placeholder = "Año"';
            } ?> value="<?= $peliculaAnyo ?>"/>
        <? } else {
            echo '<p>' . $peliculaAnyo . '</p>';
        } ?>
        <hr>


        <strong>Director: </strong>
        <?php if ($admin) { ?>
            <input type="text" name="director" <?php if ($nueva_entrada) {
                echo 'placeholder = "Director"';
            } ?> value="<?= $peliculaDirector ?>"/>
        <? } else {
            echo '<p>' . $peliculaDirector . '</p>';
        } ?>
        <hr>

        <strong>Valoracion: </strong>
        <?php if ($admin) { ?>
            <input type="number" min="0" max="10" step="0.01" name="valoracion" <?php if ($nueva_entrada) {
                echo 'placeholder = "Valoracion"';
            } ?>value="<?= $peliculaValoracion ?>"/>
        <? } else {
            echo '<p>' . $peliculaValoracion . '</p>';
        } ?>
        <hr>
        <strong>Genero: </strong>
        <?php if($admin){ ?>
        <select name="genero">
            <?php foreach ($genero as $filaGenero) { ?>
                <option value="<?= $filaGenero["id"] ?>" <?php if ($filaGenero["id"] == $peliculaGenero) {
                    echo "selected = 'true'";
                } ?>><?= $filaGenero["genero"] ?></option>
                <?php
            } ?>
        </select>
        <?php }else {
            foreach ($genero as $filaGenero) {
                if ($filaGenero["id"] == $peliculaGenero) {
                    echo '<p>' . $filaGenero["genero"] . '</p>';
                }

            }
        }?>

        <hr>
        <?php if ($admin) { ?>
            <strong>Link portada: </strong>
            <input type="text" name="portada" <?php if ($nueva_entrada) {
                echo 'placeholder = "Link"';
            } ?>value="<?= $peliculaLinkPortada ?>"/>
            <hr>

            <?php if ($nueva_entrada) { ?>
                <input type="submit" name="crear" value="Añadir peliculas" class="btn btn-secondary"/>
            <?php } else { ?>
                <input type="submit" name="guardar" value="Guardar cambios" class="btn btn-secondary"/>
            <?php } ?>
            <a href="peliculaEliminar.php?id=<?= $id ?>" class="btn btn-danger">Eliminar pelicula</a>
        <?php }?>

        <a href="peliculaListado.php" class="btn btn-secondary">Volver al listado</a>

    </form>


</div>
</body>
</html>