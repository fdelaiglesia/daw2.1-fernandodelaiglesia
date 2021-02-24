<?php

require_once "clases.php";
require_once "varios.php";

class DAO
{
    private static $pdo = null;

    private static function obtenerPdoConexionBD()
    {
        $servidor = "localhost";
        $identificador = "root";
        $contrasenna = "";
        $bd = "MiniFbDAO"; // Schema
        $opciones = [
            PDO::ATTR_EMULATE_PREPARES => false, // Modo emulación desactivado para prepared statements "reales"
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Que los errores salgan como excepciones.
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // El modo de fetch que queremos por defecto.
        ];

        try {
            $pdo = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
        } catch (Exception $e) {
            error_log("Error al conectar: " . $e->getMessage());
            exit("Error al conectar" . $e->getMessage());
        }

        return $pdo;
    }
    /*Funciones principales*/
    public static function ejecutarConsultaObtener(string $sql, array $parametros): ?array
    {
        if (!isset(DAO::$pdo)) DAO::$pdo = DAO::obtenerPdoConexionBd();

        $sentencia = DAO::$pdo->prepare($sql);
        $sentencia->execute($parametros);
        $resultado = $sentencia->fetchAll();
        return $resultado;
    }
    public static function ejecutarConsultaActualizar(string $sql, array $parametros): int
    {
        if (!isset(DAO::$pdo)) DAO::$pdo = DAO::obtenerPdoConexionBd();

        $sentencia = DAO::$pdo->prepare($sql);
        $sentencia->execute($parametros);
        return $sentencia->rowCount();
    }

    /*USUARIO*/
    public static function crearUsuario(string $identificador, string $contrasenna, string $nombre, string $apellidos)
    {
        $consulta = "INSERT INTO usuario (identificador, contrasenna, codigoCookie, caducidadCodigoCookie, tipoUsuario, nombre, apellidos) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $parametros = [$identificador, $contrasenna, NULL, NULL, 0, $nombre, $apellidos];

        return self::ejecutarConsultaActualizar($consulta, $parametros);
    }

    public static function  buscaUsuarioIdentificador(string $identificador)
    {
        $consulta = "SELECT * FROM usuario WHERE identificador=?";
        $parametros = [$identificador];

        return self::ejecutarConsultaActualizar($consulta, $parametros);
    }

    function establecerSesionCookie(Usuario $usuario)
    {
        // Creamos un código cookie muy complejo (no necesariamente único).
        $codigoCookie = generarCadenaAleatoria(32); // Random...

        self::actualizarCodigoCookieEnBD($codigoCookie);

        // Enviamos al cliente, en forma de cookies, el identificador y el codigoCookie:
        setcookie("identificador", $usuario->getIdentificador(), time() + 600);
        setcookie("codigoCookie", $codigoCookie, time() + 600);
    }

    function actualizarCodigoCookieEnBD(?string $codigoCookie)
{
    $conexion = obtenerPdoConexionBD();
    $sql = "UPDATE Usuario SET codigoCookie=? WHERE id=?";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute([$codigoCookie, $_SESSION["id"]]); // TODO Comprobar si va bien con null.

    // TODO Para una seguridad óptima convendría anotar en la BD la fecha de caducidad de la cookie y no aceptar ninguna cookie pasada dicha fecha.
}

}
