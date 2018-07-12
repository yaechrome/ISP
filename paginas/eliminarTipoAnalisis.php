<?php
include_once '../dao/TipoAnalisisDaoImp.php';
include_once '../login/sessionStart.php';

$dao = new TipoAnalisisDaoImp();
$id = $_GET['id'];

if ($dao->eliminar($id)) {
    echo "<script> alert('Tipo de Analisis eliminado con exito') </script>";
} else {
    echo "<script> alert('Error al eliminar Tipo de Analisis') </script>";
}

include_once './ventanaMantenedorTipoAnalisis.php';

