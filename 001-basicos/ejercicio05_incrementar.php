<?php

if (!isset($_REQUEST["acumulado"]) || isset($_REQUEST["reset"])) {
    $acumulado = 0;
    $diferencia = 1;
} else {
    $acumulado = (int)$_REQUEST["acumulado"];
    $diferencia = (int)$_REQUEST["diferencia"];
    if (isset($_REQUEST["suma"])) {
        $acumulado = $acumulado + $diferencia;
    } else if (isset($_REQUEST["resta"])) {
        $acumulado = $acumulado - $diferencia;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Ejercicio 5</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
</head>

<body>
<form method="get">
    <h1><?= $acumulado ?></h1>
    <input type="hidden" name="acumulado" value="<?= $acumulado ?>">

    <input type="submit" name="resta" value=" - ">
    <input type="text" name="diferencia" value="<?= $diferencia ?>">
    <input type="submit" name="suma" value=" + ">
    <input type="submit" name="reset" value="resetear">
    <!-- <a href='<?= $_SERVER["SERVER_NAME"] ?>'>resetear</a> -->
</form>
</body>
</html>
