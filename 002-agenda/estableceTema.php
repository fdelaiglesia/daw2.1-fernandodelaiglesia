<?php
session_start();
require_once "_varios.php";
$rojo =($_REQUEST['tema'] == 'rojo');
$verde =($_REQUEST['tema'] == 'verde');
$azul =($_REQUEST['tema'] == 'azul');
if(isset($_REQUEST['listado'])){
    if($rojo){
        $_SESSION['tema'] = $_REQUEST['tema'];
    }elseif ($verde){
        $_SESSION['tema'] = $_REQUEST['tema'];
    }elseif ($azul){
        $_SESSION['tema'] = $_REQUEST['tema'];
    }
    redireccionar('persona-listado.php');
}

