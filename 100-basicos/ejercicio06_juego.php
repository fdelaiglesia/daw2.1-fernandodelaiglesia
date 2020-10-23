<?php
$numero = 0;
$intentos = 0;
$minIntentos = 10;
$sugerencia = null;
$comenzar = false;
if (isset($_REQUEST["numero"])) {
    $numero = (int)$_REQUEST["numero"];

}
/*
if($numero == $sugerencia){
    if($intentos < $minIntentos) {
        $minIntentos = (int)$_REQUEST["intentos"];
    }
}*/
if (isset($_REQUEST["sugerencia"])) {

    $sugerencia = (int)$_REQUEST["sugerencia"];
    if ((int)$_REQUEST["sugerencia"] != 0) {
        $intentos = (int)$_REQUEST["intentos"] + 1;
    }
}

if (isset($_REQUEST["comenzar"])) {
    $sugerencia = null;

    $intentos = 0;

}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Ejercicio 6</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
</head>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

<style>
    #comenzar {
        background: green;
    }

    #sugerir {
        background: #262626;
    }

    input[type=submit] {
        padding: 5px 15px;

        color: white;
        border: 0 none;
        cursor: pointer;
        -webkit-border-radius: 5px;
        border-radius: 5px;
    }

    body {
        font-family: 'Roboto', sans-serif;
    }

    input:disabled {
        display: none;
    }

    .juego {
        background-color: #fafafa;
        margin: 1rem;
        padding: 1rem;
        border: 2px solid #ccc;
        /* IMPORTANTE */
        text-align: center;
        margin-left: 30%;
        margin-right: 30%;

    }
</style>
<body>
<div class="juego">

    <h1><?php
        if ($sugerencia != null) {
            if ($intentos > 10) {
                echo "HAS PERDIDO";
            } else if ($sugerencia > $numero) {
                echo "ES MENOR";
            } elseif ($sugerencia < $numero) {
                echo "ES MAYOR";
            } elseif ($sugerencia == $numero) {
                echo "ACERTASTE";
            }
        } else if (isset($_REQUEST["comenzar"])) {
            echo "JUGADOR 2 ADIVINA EL NUMERO";
        } else if ($sugerencia == null) {
            echo "JUGADOR 1 INTRODUCE EL NUMERO";
        }
        ?></h1>
    <p>Intentos: <?= $intentos ?> /maximo 10</p>
    <!--<p>Numero minimo de intentos: <?= $minIntentos ?></p>-->
    <form method="post">
        <input type="<?php if (!isset($_REQUEST["sugerencia"]) || $intentos > 10 || $numero == $sugerencia) {
            echo "text";
        } else {
            echo "hidden";
        } ?>" name="numero" value="<?= $numero ?>">

        <input type="submit" id="comenzar" <?php if (!isset($_REQUEST["sugerencia"]) || $intentos > 10 ||
            $numero == $sugerencia) {
            echo "";
        } else {
            echo "disabled";
        } ?> name="comenzar" value="Comenzar">
        <input type="<?php if (!isset($_REQUEST["sugerencia"]) || $numero == $sugerencia || $intentos > 10) {
            echo "hidden";
        } else {
            echo "text";
        } ?>" name="sugerencia" value="<?= $sugerencia ?>">
        <input type="submit" <?php if (!isset($_REQUEST["sugerencia"]) || $numero == $sugerencia || $intentos > 10) {
            echo "disabled";
        } else {
            echo "";
        } ?> name="sugerir" value="Sugerir" id="sugerir"><br>

        <input type="hidden" name="intentos" value="<?= $intentos ?>">
        <input type="hidden" name="minIntentos" value="<?= $minIntentos ?>">

    </form>
</div>

</body>

</html>