<?php
include_once '../dto/Usuario.php';
include_once '../dao/UsuarioDaoImp.php';
include_once '../dto/Empleado.php';
include_once '../login/sessionStart.php';
include_once './perfilesEmpleados.php';
$dao = new UsuarioDaoImp();
$usuario = $_SESSION["usuario"];
$rut = $usuario->getRut();
$nombre = $usuario->getNombre();
$estado = $usuario->getEstado();


if ($_SESSION['tipo'] == 'usuario') {
    $codigo = $usuario->getCodigo();
    $perfil = $usuario->getPerfil();
    $direccion = $usuario->getDireccion();
    $email = $usuario->getEmail();
} else {
    $categoria = $usuario->getCategoria();
    $perfil = nombreCompletoCategoria($categoria);
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
        <div class="grid-wrapper elemento-formulario">
            <?php if ($_SESSION['tipo'] == 'usuario') { ?>
                <div>Código:</div>
                <div><input type="text" name="txtCodigo" value="<?= $codigo ?>" disabled/></div>
            <?php } ?>
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
        <a href="ventanaEditarMisDatos.php">Editar</a>
        <a href=../login/volver.php>Volver</a> <br>
    </body>
</html>
