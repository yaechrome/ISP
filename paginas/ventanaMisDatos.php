<?php
include_once '../dto/Usuario.php';
include_once '../dao/UsuarioDaoImp.php';
include_once '../dto/Empleado.php';
session_start();
$dao = new UsuarioDaoImp();
$usuario = $_SESSION["usuario"];
$rut = $usuario->getRut();
$nombre = $usuario->getNombre();
$estado = $usuario->getEstado();

if ($_SESSION['tipo'] == 'usuario') {
    $perfil = $usuario->getPerfil();
    $direccion = $usuario->getDireccion();
    $email = $usuario->getEmail();
}else{
    $perfil = $usuario->getCategoria();
    $direccion = "";
    $email = "";
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mis Datos</title>
        <style>
            .grid-wrapper {
                display: grid;
                grid-template-columns: 25% 25% 25% 25%;
                grid-gap: 10px;
            }
            .container-formulario {
                display: grid;
                grid-template-columns: 100%;
                justify-items: center;
            }
            
            .elemento-formulario {
                min-width: 300px;
            }
            #myChart {

            }
        </style>
    </head>
    <body>
        <h1>Mis Datos</h1>
        <form action="misDatos.php" method="POST">
            <div class="grid-wrapper elemento-formulario">
                <div>Rut:</div>
                <div><input type="text" name="txtRut" value="<?= $rut ?>" disabled/></div>
                <div>Nombre:</div>
                <div><input type="text" name="txtNombre" value="<?= $nombre ?>" disabled/></div>
                <div>Perfil:</div>
                <div><input type="text" name="txtPerfil" value="<?= $perfil ?>" disabled/></div>
                <div>Estado:</div>
                <div><input type="text" name="txtEstado" value="<?= $estado ?>" disabled/></div>
                <?php if ($_SESSION['tipo'] == 'usuario') { ?>
                <div>Direccion:</div>
                <div><input type="text" name="txtDireccion" value="<?= $direccion ?>" disabled/></div>
                <div>Email:</div>
                <div><input type="text" name="txtEmail" value="<?= $email ?>" disabled/></div>
                 <?php } ?>
            </div>
        </form>
        <a href=../login/volver.php>Volver</a> <br>
    </body>
</html>
