<?php
include_once '../dao/TipoAnalisisDaoImp.php';
include_once '../login/sessionStart.php';

$nombre = $_POST["txtNombre"];
$dao = new TipoAnalisisDaoImp();
$mensaje = null;
if($dao->existeRegistro($nombre)){
    $mensaje = 'Tipo de analisis ya existe';
}else{
    if($dao->crear($nombre)){
        $mensaje = 'Tipo de analisis creado correctamente';
    }else{
        $mensaje = 'No se pudo crear Tipo de analisis';
    }
}
echo "<script> alert('$mensaje') </script>";
include_once './ventanaMantenedorTipoAnalisis.php';