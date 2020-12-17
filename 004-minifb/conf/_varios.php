<?php

declare(strict_types=1);
session_start();
function conectarBD(): PDO
{
    $servidor = "localhost";
    $bd = "MiniFb";
    $identificador = "root";
    $contrasenna = "";
    $opciones = [
        PDO::ATTR_EMULATE_PREPARES => false, // turn off emulation mode for "real" prepared statements
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
    ];

    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
    } catch (Exception $e) {
        error_log("Error al conectar: " . $e->getMessage()); // El error se vuelca a php_error.log
        exit('Error al conectar'); //something a user can understand
    }

    return $conexion;
}
//TODO: Verificar que el usuario no existe.
function registrarUsuario(string $identificador, string $contrasenna)
{

    $pdo = conectarBD();
    $compruebo = "SELECT * FROM Usuario WHERE identificador='$identificador'";
    $select = $pdo->prepare($compruebo);
    $select->execute();
    $registro = $select->fetchAll();
    if (count($registro) == 0) {
        $identificador = $_REQUEST["identificador"];
        $contrasenna =  password_hash($_REQUEST["contrasenna"], PASSWORD_BCRYPT);
        $fechaRegistro = date("Y-m-d H:i:s");
        $avatar = ' ';
        $nombre = $_REQUEST["nombre"];
        $apellidos = $_REQUEST["apellidos"];
        $sql = "INSERT INTO Usuario (identificador, contrasenna,fechaRegistro,avatar,nombre,apellidos) VALUES (?,?,?,?,?,?)";
        $parametros = [$identificador, $contrasenna, $fechaRegistro, $avatar, $nombre, $apellidos];
        $sentencia = $pdo->prepare($sql);
        $sql_con_exito = $sentencia->execute($parametros);
        return redireccionar("sesionInicio.php?usuario");
    } else {
        return 'El usuario ya existe';
    }
}

function obtenerUsuario(string $identificador, string $contrasenna)
{
    $pdo = conectarBD();
    $sql = "SELECT * FROM Usuario WHERE identificador='$identificador'";
    $select = $pdo->prepare($sql);
    $select->execute();
    $login = $select->fetchAll();
    if (count($login) > 0 && password_verify($contrasenna, $login[0]["contrasenna"])) {

        marcarSesionComoIniciada($login[0]['id'], $login[0]['identificador'], $login[0]['contrasenna']);
        return $login;
    } else {
        return null;
    }
}

function obtenerUsuarioId($id)
{

    $pdo = conectarBD();
    $sql = "SELECT * FROM Usuario WHERE id='$id'";
    $select = $pdo->prepare($sql);
    $select->execute();
    $user = $select->fetchAll();
    return $user;
}

function marcarSesionComoIniciada(
    int $id,
    string $identificador,
    string $contrasenna
) {
    $_SESSION['id'] = $id;
    $_SESSION['identificador'] = $identificador;
    $_SESSION['contrasenna'] = $contrasenna;
}


function haySesionIniciada()
{
    return isset($_SESSION["id"]);
}

function cerrarSesion()
{
    session_destroy();
    session_unset();
    redireccionar("sesionInicio.php");
}

// (Esta función no se utiliza en este proyecto pero se deja por si se optimizase el flujo de navegación.)
// Esta función redirige a otra página y deja de ejecutar el PHP que la llamó:
function redireccionar(string $url)
{
    header("Location: $url");
    exit;
}

function syso(string $contenido)
{
    file_put_contents('php://stderr', $contenido . "\n");
}

function generarCodigo($longitud)
{
    $key = '';
    $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
    $max = strlen($pattern) - 1;
    for ($i = 0; $i < $longitud; $i++) {
        $key .= $pattern{
        mt_rand(0, $max)};
    }
    return $key;
}

//:TODO: Hacer subirArchivo();
function subirAvatar($archivo, string $nombre)
{
}
