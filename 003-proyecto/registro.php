<?php
require_once "_varios.php";
$mensaje ="";
if(!empty($_POST["usuario"]) && !empty($_POST["contrasenya"]) && !empty($_POST["email"])) {
    $pdo = conectarBD();
    $usuario = $_REQUEST["usuario"];
    $contrasenya = $_REQUEST["contrasenya"];
    $email = $_REQUEST["email"];
    $sql = "INSERT INTO usuario (usuario, contrasenya,email) VALUES (?,?,?)";
    $parametros = [$usuario, $contrasenya, $email];
    $sentencia = $pdo->prepare($sql);
    $sql_con_exito = $sentencia->execute($parametros);
    redireccionar("login.php?registro");
}
?>

<head>
    <meta charset="utf-8">
    <title>HTML</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require 'partials/css.php'?>
</head>

<body>
<?php require 'partials/navbar.php'?>
<div id="body">
<h1>Registrarse en Videoclub</h1>
<form action="registro.php" method="post">
    <p>Usuario: <input type="text" name="usuario"></p>
    <p>Contraseña: <input type="password" name="contrasenya"></p>
    <p>Email: <input type="text" name="email"></p>
    <input type="submit" name="guardar" class="btn btn-secondary">
    <a href="login.php" class="btn btn-secondary">Loguearse</a
</form>
<?=$mensaje?>
    <div>
</body>
</html>