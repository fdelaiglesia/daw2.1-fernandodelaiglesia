<?php
session_start();
require_once "_varios.php";
$mensaje = '';
if (isset($_SESSION['usuario'])) {
    redireccionar("peliculaListado.php");
}
if (isset($_REQUEST["guardar"])) {
    if (!empty($_POST["usuario"]) && !empty($_POST["contrasenya"])) {
        $pdo = conectarBD();
        $sql = "SELECT id,usuario,contrasenya FROM usuario WHERE usuario=:usuario";
        $select = $pdo->prepare($sql);
        $select->bindParam(':usuario', $_POST["usuario"]);
        $select->execute();
        $login = $select->fetchAll();
        if (count($login) > 0 && $_POST["contrasenya"] == $login[0]["contrasenya"]) {
            $_SESSION['usuarioId'] = $login[0]["id"];
            $_SESSION['usuario'] = $login[0]["usuario"];
            redireccionar("peliculaListado.php");
        } else {
            $mensaje = "<p class='mensaje'>No existe este usuario o ha introducido mal la contraseña</p>";
        }
    } else {
        $mensaje = "<p class='mensaje'>Algo esta en blanco</p>";
    }
}
if (isset($_REQUEST["registro"])) {
    $mensaje =  '<p class="mensajeCorrecto">Usuario creado correctamente</p>';
}

?>
<head>
    <meta charset="utf-8">
    <title>Videoclub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require 'partials/css.php' ?>
</head>

<body>
<?php require 'partials/navbar.php' ?>
<div id="body">
    <h1>Videoclub</h1>
    <p><?= $mensaje ?></p>
    <form action="login.php" method="post">
        <div class="form-group">
            <p>Usuario: <input type="text" name="usuario"></p>
            <p>Contraseña: <input type="password" name="contrasenya"></p>
            <input type="submit" name="guardar" value="Enviar" class="btn btn-secondary">


        </div>
    </form>
    <a href="registro.php" class="btn btn-danger">Registrarse</a>
</div>
</body>
</html>