<?php

require_once "_com/DAO.php";




$posibleClausulaWhere = isset($_REQUEST["soloEstrellas"]) ? "WHERE estrella=1" : "";

$personas = DAO::personaObtenerTodas($posibleClausulaWhere);
$categorias = DAO::categoriaObtenerTodas();

?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

    <h1>Listado de Personas</h1>

    <table border='1'>

        <tr>
            <th>Persona</th>
            <th>Categoría</th>
        </tr>

        <?php
        foreach ($personas as $persona) { ?>
            <tr>
                <td>
                    <?php
                    $urlImagen = $persona->getEstrella() ? "img/EstrellaRellena.png" : "img/EstrellaVacia.png";
                    echo " <a href='PersonaEstablecerEstadoEstrella.php?id=".$persona->getId()."'><img src='$urlImagen' width='16' height='16'></a> ";

                    echo "<a href='PersonaFicha.php?id=".$persona->getId()."'>";
                    echo $persona->getNombre();
                    if ($persona->getApellidos() != "") {
                        echo $persona->getApellidos();
                    }
                    echo "</a>";
                    ?>
                </td>
                <td><a href='CategoriaFicha.php?id=<?= $persona->getCategoriaId() ?>'> <?= DAO::personaObtenerCategoria($persona->getCategoriaId()); ?> </a></td>
                <td><a href='PersonaEliminar.php?id=<?= $persona->getId() ?>'> (X) </a></td>
            </tr>
        <?php } ?>

    </table>

    <br />

    <?php if (!isset($_REQUEST["soloEstrellas"])) { ?>
        <a href='PersonaListado.php?soloEstrellas'>Mostrar solo contactos con estrella</a>
    <?php } else { ?>
        <a href='PersonaListado.php?todos'>Mostrar todos los contactos</a>
    <?php } ?>

    <br />
    <br />

    <a href='PersonaFicha.php?id=-1'>Crear entrada</a>

    <br />
    <br />

    <a href='CategoriaListado.php'>Gestionar listado de Categorías</a>

</body>

</html>