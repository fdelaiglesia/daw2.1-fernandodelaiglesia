<?php
$operando1 = $_REQUEST["operando1"];
$operando2 = $_REQUEST["operando2"];
$operacion = $_REQUEST["operacion"];
$resultado = null;
$denOperacion = null;
$div0 = false;
$nada = false;
if ($_REQUEST["operando1"] != null && $_REQUEST["operando1"] != null) {
    if ($operacion == "sum") {
        $resultado = $operando1 + $operando2;
        $denOperacion = "suma";
    } else if ($operacion == "res") {
        $resultado = $operando1 - $operando2;
        $denOperacion = "resta";
    } else if ($operacion == "mul") {
        $resultado = $operando1 * $operando2;
        $denOperacion = "multiplicación";
    } else if ($operacion == "div") {
        if ($operando2 != 0) {
            $resultado = $operando1 / $operando2;
            $denOperacion = "división";
        } else {
            $div0 = true;
        }
    }
} else if ($_REQUEST["operando1"] == null && $_REQUEST["operando1"] == null) {
    $nada = true;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>HTML</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
</head>
<style>body {
        background-color: #fafafa;
        margin: 1rem;
        padding: 1rem;
        border: 2px solid #ccc;
        text-align: center;
        margin-left: 30%;
        margin-right: 30%;

    }</style>
<body>
<?php if ($div0 == true) {
    echo '<p>No se puede dividir entre 0</p>';
} else if ($nada == true) {
    echo '<p>No ha introducido nada</p>';
} else { ?>
    <p>El resultado de la <?= $denOperacion ?> entre <?= $operando1 ?> y <?= $operando2 ?> es <?= $resultado ?> </p>
<?php } ?>
<form action="ejercicio08a_calculadora.php" method="post">
    <input type="submit" value="Realizar otra operacion">
</form>
</body>
</html>



