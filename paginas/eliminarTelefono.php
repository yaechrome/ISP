<?php

include_once '../dao/TelefonoDaoImp.php';

$dao = new TelefonoDaoImp();
$id = $_GET['id'];


if ($dao->eliminar($id)) {
    echo "<script> alert('telefono eliminado con exito') </script>";
} else {
    echo "<script> alert('Error al eliminar') </script>";
}

include_once '../paginas/ventanaTelefonos.php';