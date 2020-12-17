<?php
require "conf/_varios.php";
$mensaje= '';
if(haySesionIniciada()){
    redireccionar("perfilUsuario.php");
}
if (isset($_REQUEST['loguearse'])) {
    $arrayUser =  obtenerUsuario($_REQUEST['identificador'], $_REQUEST['contrasenna']);
    if($arrayUser ){
        redireccionar("perfilUsuario.php");
}else{
    $mensaje = '<p>No existe el usurario</p>';
}
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
    <form action="sesionInicio.php" method="post">
        <label for="identificador">Usuario:</label>
        <input type="text" name="identificador">
        <hr>
        <label for="contrasenna">Contraseña:</label>
        <input type="password" name="contrasenna">
        <hr>
        <label for="recuerdame">Recuerdame</label>
        <input type="checkbox" name="recuerdame">
        <hr>
        <input type="submit" name="loguearse">
    </form>
    <a href="sesionRegistro.php">Registrarse</a>
</body>

</html>