<?php

include_once '../login/sessionStart.php';
include_once '../dao/UsuarioDaoImp.php';
include_once '../dto/Usuario.php';

$userDao = new UsuarioDaoImp();
$rut = trim($_POST["txtRut"]);

if ($rut == "") {
    echo "<script> alert('Debe ingresar un rut') </script>";
    include_once './ventanaBuscarCliente.php';
} else {
    $cliente = $userDao->buscarPorRutCliente($rut);
    $_SESSION["cliente"] = $cliente;
    if ($cliente == null) {
        echo "<script> alert('RUT no pertenece a un usuario registrado') </script>";
        include_once './ventanaBuscarCliente.php';
    } else {
        include_once './ventanaRecepcionMuestras.php';
    }
}
