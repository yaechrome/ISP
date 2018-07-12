<?php
include_once '../dao/TipoAnalisisDaoImp.php';
include_once '../login/sessionStart.php';


$id = trim($_POST["txtId"]);
$dao = new TipoAnalisisDaoImp();
$dto = $dao->buscarPorClavePrimaria($id);
$lista = array($dto);

if(!$dto->getId() == $id){
    $mensaje = 'No existe tipo de analisis con ese ID';
    $lista = $dao->listar();
    $_SESSION["listaDesplegar"]= $lista;
} else{
    $_SESSION["listaDesplegar"]= $lista;
}



if($mensaje!= null){
        echo "<script> alert('$mensaje') </script>";
}

include_once 'ventanaMantenedorTipoAnalisis.php';