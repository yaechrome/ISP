<?php

include_once '../dto/Usuario.php';
include_once '../dao/UsuarioDaoImp.php';
include_once '../dao/AnalisisMuestraDaoImp.php';
include_once '../dto/AnalisisMuestras.php';
include_once '../login/sessionStart.php';

$usuario = $_SESSION["usuario"];

$dao = new AnalisisMuestraDaoImp();
$codigo = $_POST["txtCodigoMuestra"];
$mensaje = null;
if ($_SESSION['tipo'] == 'usuario') {
    $codUsuario = $usuario->getCodigo();
    $analisis = $dao->buscarPorClavePrimaria($codigo);
    if ($analisis != null) {
        $cod = $analisis->getUsuario()->getCodigo();
        if ($codUsuario == $cod) {
            $_SESSION["busquedaMuestas"] = $analisis;
        } else {
            $mensaje = 'Analisis no pertece a este usuario';
        }
    } else {
        $_SESSION["busquedaMuestas"] = null;
    }
} else {
    $codUsuario = $usuario->getRut();
    $analisis = $dao->buscarPorClavePrimaria($codigo);
    if ($analisis != null) {
        if ($usuario->getCategoria() == 'R') {
            $cod = $analisis->getEmpleado()->getRut();
            if ($codUsuario == $cod) {
                $_SESSION["busquedaMuestas"] = $analisis;
            } else {
                $mensaje = 'Analisis no pertece a este usuario';
            }
        }
        if ($usuario->getCategoria() == 'T') {
            
        }
    } else {
        
    }
}

if ($mensaje != null) {
    echo "<script> alert('$mensaje') </script>";
}

include_once './ventanaBusquedaMuestras.php';
