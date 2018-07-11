<?php
include_once '../dto/Usuario.php';
include_once '../dao/UsuarioDaoImp.php';
include_once '../dto/Contacto.php';
include_once '../dao/ContactoDaoImp.php';
include_once '../login/sessionStart.php';


include_once '../dto/Usuario.php';
include_once '../dao/UsuarioDaoImp.php';
include_once '../dao/AnalisisMuestraDaoImp.php';
include_once '../dto/AnalisisMuestras.php';
include_once '../login/sessionStart.php';


$usuario = $_SESSION["usuario"];
$codUsuario = $usuario->getCodigo();	
$dao = new AnalisisMuestraDaoImp();
$codigo = $_POST["txtCodigoMuestra"];
$analisis = $dao->buscarPorClavePrimaria($codigo);
$mensaje = null;
if($analisis != null){
$cod = $analisis->getUsuario()->getCodigo();
    if($codUsuario == $cod){
        $_SESSION["busquedaMuestasCliente"] = $analisis;
    }else{
        $mensaje ='Analisis no pertece a este usuario';
    }
}else{
    $mensaje = 'Codigo no existe';
}
if($mensaje!= null){
    echo "<script> alert('$mensaje') </script>";
}
include_once './ventanaBusquedaMuestras.php';