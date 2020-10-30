<?php

$operando1 = null;
$operando2 = null;
$operacion = null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>HTML</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
</head>
<style>
    body {
        background-color: #fafafa;
        margin: 1rem;
        padding: 1rem;
        border: 2px solid #ccc;
        text-align: center;
        margin-left: 30%;
        margin-right: 30%;

    }
</style>
<body>

<form action="ejercicio08b_calculadora.php" method="get">
    <input type="number" name="operando1">
    <select name="operacion">
        <option value="sum">Sumar</option>
        <option value="res">Restar</option>
        <option value="mul">Multiplicar</option>
        <option value="div">Dividir</option>
    </select>
    <input type="number" name="operando2">
    <input type="submit" value="Calcular">

</form>
</body>
</html>


