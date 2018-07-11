<?php

include_once '../login/sessionStart.php';
include_once '../dao/ContactoDaoImp.php';
include_once '../dto/Contacto.php';
include_once '../dto/Usuario.php';

$dao = new ContactoDaoImp();
$contacto = new Contacto();

$empresa = $_SESSION["usuario"];
$nombre = trim($_POST['txtNombre']);
$rut = trim($_POST['txtRut']);
$email = trim($_POST['txtEmail']);
$telefono = trim($_POST['txtTelefono']);

$contacto->setRut($rut);
$contacto->setNombre($nombre);
$contacto->setEmail($email);
$contacto->setTelefono($telefono);
$contacto->setEmpresa($empresa);


if ($dao->crear($contacto)) {
    echo "<script> alert('Contacto agregado con exito') </script>";
} else {
    echo "<script> alert('Error al agregar contacto') </script>";
}


include_once './ventanaContactos.php';


