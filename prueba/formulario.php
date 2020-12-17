<?php if (isset($_REQUEST['enviado'])) {
    $mensaje = 'Mensaje enviado';
} else {
    $mensaje = '';
}?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>HTML</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
<p><?=$mensaje?></p>
<form action="enviar.php" method="post">
    <label for="email">email</label><br>
    <input type="text" id="email" name="email"><br>
    <label for="nombre">Nombre</label><br>
    <input type="text" id="nombre" name="nombre"><br>
    <label for="nombre">Mandar a:</label><br>
    <input type="text" id="nombre" name="emailEnvio"><br>
    <label for="error">Error</label><br>
    <textarea name="error"></textarea><br>
    <input type="submit"  name="enviar" value="enviar">
</form>
</body>
</html>
