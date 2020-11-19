<?php
function conectarBD(): PDO
{
    $servidor = "localhost";
    $user = "root";
    $contrasenya = "";
    $bd = "videoclub";
    $opciones = [
        PDO::ATTR_EMULATE_PREPARES => false, // turn off emulation mode for "real" prepared statements
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
    ];

    try {
        $pdo = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $user , $contrasenya, $opciones);
    } catch (Exception $e) {
        error_log("Error al conectar: " . $e->getMessage());
        exit('Error al conectar');
    }

    return $pdo;
}

function redireccionar(string $url)
{
    header("Location: $url");
    exit;
}

function syso(string $contenido)
{
    file_put_contents('php://stderr', $contenido . "\n");
}

?>
