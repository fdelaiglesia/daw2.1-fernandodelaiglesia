<?php
$listaNombres = [
    14 => "jorge",
    1 => "luis",
    27 => "amador",
    3 => "julian"
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Ejercicio 3</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
</head>

<body>
<select>
    <?php
    foreach ($listaNombres as $id => $nombre) { ?>
        <option value="<?= $id ?>"><?= $nombre ?></option>
    <?php } ?>
</select>
</body>
</html>
