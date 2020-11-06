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
    $persona_nombre = "";
    $persona_apellido = "";
    $persona_telefono = "";
    $persona_idc = "";
} else { // Quieren VER la ficha de una categoría existente, cuyos datos se cargan.
    $sqlPersona = "SELECT * FROM persona  WHERE id=? ";

    $selectPersona = $pdo->prepare($sqlPersona);
    $selectPersona->execute([$id]); // Se añade el parámetro a la consulta preparada.
    $rsPersona = $selectPersona->fetchAll();

    // Con esto, accedemos a los datos de la primera (y esperemos que única) fila que haya venido.
    $persona_nombre = $rsPersona[0]["nombre"];
    $persona_apellido = $rsPersona[0]["apellido"];
    $persona_telefono = $rsPersona[0]["telefono"];
    $persona_estrella = $rsPersona[0]["estrella"];
    $persona_idc = $rsPersona[0]["categoria_id"];



}
$sqlCategoria = "SELECT * FROM categoria";
$selectCategoria = $pdo->prepare($sqlCategoria);
$selectCategoria->execute([]);
$rsCategoria = $selectCategoria->fetchAll();

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

    <form method="post" action="persona-guardar.php">

        <input type="hidden" name="id" value="<?= $id ?>"/>

        <ul class="list-group">
            <li class="list-group-item list-group-item-action">
                <strong>Nombre: </strong>
                <input type="text" name="nombre" <?php if ($nueva_entrada) {
                    echo 'placeholder = "Nombre"';} ?> value="<?= $persona_nombre ?>"/>
            </li>
            <li class="list-group-item list-group-item-action">
                <strong>Apellido: </strong>
                <input type="text" name="apellido" <?php if ($nueva_entrada) {
                    echo 'placeholder = "Apellido"';} ?> value="<?= $persona_apellido ?>"/>
            </li>
            <li class="list-group-item list-group-item-action">
                <strong>Telefono: </strong>
                <input type="text" name="telefono" <?php if ($nueva_entrada) {
                    echo 'placeholder = "Telefono"';
                } ?>value="<?= $persona_telefono ?>"/>
            </li>
            <li class="list-group-item list-group-item-action">
                <strong>Favorito: </strong>
                <input type="hidden" name="estrella" value="0">
                <input type="checkbox" name="estrella" value="1"

                    <?php if(!$nueva_entrada){
                    if ($persona_estrella == 1) {
                        echo 'checked';
                        $persona_estrella == 1;
                    }} ?>/>
            </li>
            <li class="list-group-item list-group-item-action">
                <strong>Categoria: </strong>
                <select name="categoria_id">
                    <?php foreach ($rsCategoria as $fila) { ?>
                        <option value="<?= $fila["id"] ?>" <?php if ($fila["id"] == $persona_idc) {
                            echo "selected = 'true'";
                        } ?>><?= $fila["nombre"] ?></option>
                        <?php
                    } ?>
                </select>
            </li>
        </ul>

        <?php if ($nueva_entrada) { ?>
            <input type="submit" name="crear" value="Añadir persona" class="btn btn-primary"/>
        <?php } else { ?>
            <input type="submit" name="guardar" value="Guardar cambios" class="btn btn-primary"/>
        <?php } ?>

    </form>

    <br/>

    <a href="persona-eliminar.php?id=<?= $id ?>" class="btn btn-primary">Eliminar Personas</a>


    <a href="persona-listado.php" class="btn btn-primary">Volver al listado de personas</a>
</div>
</body>

</html>
