<?php
include_once '../dao/UsuarioDaoImp.php';
include_once '../login/sessionStart.php';
include_once './perfilesEmpleados.php';
$dao = new UsuarioDaoImp();
$usuario = $_SESSION["usuario"];
$rut = $usuario->getRut();
$nombre = $usuario->getNombre();
$estado = $usuario->getEstado();
$password = $usuario->getPassword();
if ($_SESSION['tipo'] == 'usuario') {
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
        </style>
    </head>

    <body>
        <h1>Mis Datos</h1>
        <form action="editarMisDatos.php" method="POST">
            <div class="grid-wrapper elemento-formulario">
                <div>Rut:</div>
                <div><input type="text" name="txtRut" value="<?= $rut ?>" disabled/></div>
                <div>Nombre:</div>
                <div><input type="text" name="txtNombre" value="<?= $nombre ?>" /></div>
                <div>Perfil:</div>
                <?php if ($_SESSION['tipo'] == 'empleado' && $usuario->getCategoria() == 'A') { ?>
                    <div><select name="cmbPerfil">
                        <?php selectPerfilesEmpleados($categoria); ?>
                    </select></div>
                <?php } else { ?>
                    <div><input type="text" name="txtPerfil" value="<?= $perfil ?>" disabled/></div>
                <?php } ?>
                <div>Estado:</div>
                <div><input type="text" name="txtEstado" value="<?= $estado ?>" /></div>
                <?php if ($_SESSION['tipo'] == 'usuario') { ?>
                    <div>Direccion:</div>
                    <div><input type="text" name="txtDireccion" value="<?= $direccion ?>" /></div>
                    <div>Email:</div>
                    <div><input type="text" name="txtEmail" value="<?= $email ?>" /></div>
                <?php } ?>
                <div>Password:</div>
                <div><input type="password" name="txtPassword" value="<?= $password ?>" /></div>
            </div>
            <input type="submit" value="Guardar" name="btnGuardar" />
        </form>
        <a href=../login/volver.php>Volver</a> <br>
    </body>
</html>
