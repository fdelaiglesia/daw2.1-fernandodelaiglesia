<?php
require "conf/_varios.php";
if (isset($_REQUEST['registrarse'])) {
    echo registrarUsuario($_REQUEST['identificador'], $_REQUEST['contrasenna'], $_REQUEST['nombre'], $_REQUEST['apellidos']);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>HTML</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <form action="sesionRegistro.php" method="post" enctype="multipart/form-data">
        <label for="identificador">Usuario</label>
        <input type="text" name="identificador">
        <hr>
        <label for="contrasenna">Contraseña:</label>
        <input type="password" name="contrasenna">
        <hr>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre">
        <hr>
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos">
        <hr>
        <input type="submit" name="registrarse">
    </form>
    <a href="sesionInicio.php">Ya tengo una cuenta</a>
</body>

</html>