<?php
require_once "_varios.php";

$pdo = obtenerPdoConexionBD();
$id = $_REQUEST["id"];

$sql = "UPDATE persona SET estrella = (NOT (SELECT estrella FROM persona WHERE id=?)) WHERE id=?";
$parametros = [$id,$id];
$sentencia = $pdo->prepare($sql);
$sql_con_exito = $sentencia->execute($parametros);
$mostrarSoloEstrellas = isset($_REQUEST["soloFavs"]);
if($mostrarSoloEstrellas){
redireccionar("persona-listado.php?soloFavs");
}else{
    redireccionar("persona-listado.php");
}
