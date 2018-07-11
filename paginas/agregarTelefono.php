<?php
include_once '../login/sessionStart.php';
include_once '../dao/TelefonoDaoImp.php';
include_once '../dto/Telefono.php';
$numero = trim($_POST["txtNuevo"]);
$dao = New TelefonoDaoImp();
$usuario = $_SESSION["usuario"];

$telefono = new Telefono();
$telefono->setNumero($numero);
$telefono->setParticular($usuario);
if (!$dao->crear($telefono)) {
   
    echo "<script> alert('No se pudo agregar telefono') </script>";
}
include_once './ventanaTelefonos.php';
