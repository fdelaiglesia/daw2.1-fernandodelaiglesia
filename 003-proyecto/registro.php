<?php
require_once "_varios.php";
$mensaje ="";
if(!empty($_POST["usuario"]) && !empty($_POST["contrasenya"]) && !empty($_POST["email"])) {
    $pdo = conectarBD();
    $sql = "SELECT id,usuario,contrasenya FROM usuario WHERE usuario=:usuario";
    $select = $pdo->prepare($sql);
    $select->bindParam(':usuario', $_POST["usuario"]);
    $select->execute();
    $registro = $select->fetchAll();
    //Comprobar si el usuario que esta introduciendo ya existe
    //Basicamente es para no crear un admin
    if(count($registro)== 0){
    $usuario = $_REQUEST["usuario"];
    $contrasenya = $_REQUEST["contrasenya"];
    $email = $_REQUEST["email"];
    $sql = "INSERT INTO usuario (usuario, contrasenya,email) VALUES (?,?,?)";
    $parametros = [$usuario, $contrasenya, $email];
    $sentencia = $pdo->prepare($sql);
    $sql_con_exito = $sentencia->execute($parametros);
    redireccionar("login.php?registro");
    }else{
        //si el usuario existe manda este mensaje
        $mensaje='<p class="mensaje">El usuario ya existe</p>';
    }
}elseif(isset($_POST["guardar"])){
    //Si ha pulsado el boton y ha dejado algun cambpo en blanco manda este mensjae
    $mensaje='<p class="mensaje">Has dejado algun campo en blanco</p>';
}
?>

<head>
    <meta charset="utf-8">
    <title>Videoclub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require 'partials/css.php'?>
</head>

<body>
<?php require 'partials/navbar.php'?>
<div id="body">
<h1>Registrarse en Videoclub</h1>
    <?=$mensaje?>
<form action="registro.php" method="post">
    <p>Usuario: <input type="text" name="usuario" maxlength="10"></p>
    <p>Contraseña: <input type="password" name="contrasenya"></p>
    <p>Email: <input type="text" name="email"></p>
    <input type="submit" name="guardar" class="btn btn-secondary">

</form>
    <a href="login.php" class="btn btn-danger">Loguearse</a
    <div>
</body>
</html>