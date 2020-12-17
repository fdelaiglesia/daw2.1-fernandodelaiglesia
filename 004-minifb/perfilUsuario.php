<?php
require_once "conf/_varios.php";
if(!$_SESSION['id']){
    redireccionar("sesionInicio.php");
}
$arrayUser = obtenerUsuarioId($_SESSION['id']); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>HTML</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<a href="sesionCerrar.php">Cerrar sesion</a>
<img src="avatars/<?php if($arrayUser[0]['avatar'] == ' '){
    echo 'default.png';
}else{
    echo $arrayUser[0]['avatar'] ;
} ?>" width="100" height="100">
<h1><?=$arrayUser[0]['identificador'] ?></h1>
<p>Fecha de registro: <?php echo date("d/m/Y",strtotime($arrayUser[0]['fechaRegistro']));  ?></p>
<p>nombre: <p><p><?=$arrayUser[0]['nombre']?>
<p>apellidos: <p><p><?=$arrayUser[0]['apellidos']?>
<body>
</body>
</html>
