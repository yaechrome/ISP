<?php

include_once '../login/sessionStart.php';
include_once '../dao/UsuarioDaoImp.php';
include_once '../dao/EmpleadoDaoImp.php';

$daoUsuario = new UsuarioDaoImp();
$daoEmpleado = new EmpleadoDaoImp();

$usuario = $_SESSION["usuario"];
$nombre = trim($_POST['txtNombre']);
$estado = trim($_POST['txtEstado']);

$dto = $usuario;
$dto->setNombre($nombre);
$dto->setEstado($estado);
    

if ($_SESSION['tipo'] == 'usuario') {
    $direccion = trim($_POST['txtDireccion']);
    $email = trim($_POST['txtEmail']);
    $dto->setDireccion($direccion);
    $dto->setEmail($email);
    if ($daoUsuario->modificar($dto)) {
        echo "<script> alert('Usuario modificado con exito') </script>";
        var_dump($dto);
        $_SESSION["usuario"] = $dto;
    } else {
        echo "<script> alert('Error al modificar Usuario') </script>";
    }
} else {
    if ($usuario->getCategoria() == 'A') {
        $perfil = trim($_POST['cmbPerfil']);
    } else {
        $perfil = $usuario->getCategoria();
    }
    $dto->setCategoria($perfil);
    var_dump($dto);
    if ($daoEmpleado->modificar($dto)) {
        echo "<script> alert('Empleado modificado con exito') </script>";
    } else {
        echo "<script> alert('Error al modificar Empleado') </script>";
    }
}




include_once '../login/volver.php';
