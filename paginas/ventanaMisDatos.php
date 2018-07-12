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

if (isset($_POST['accion']) && $_POST['accion'] == 'Dar de baja') {

    $dao = new UsuarioDaoImp();

    $sePudoDarDeBaja = $dao->darDeBaja($codigo);

    $mensaje = $sePudoDarDeBaja ? "Se dio de baja al usuario con RUT $rut." : "Hubo un problema al intentar dar de baja al usuario con RUT $rut.";
    echo "<script> alert('$mensaje') </script>";

    include_once '../login/logout.php';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../static/css/postulacion.css" type="text/css"/>
        <meta charset="UTF-8">
        <title>Mis Datos</title>
    </head>
    <body>
        <main role="main">
            <section class="container">
                <div class="row mb0 center-align relative full">
                    <div class="center">
                        <div class="col s12 m6 offset-m3 l4 offset-l4">
                            <div class="card">
                                <div class="card-panel pad0">
                                    <div class="card-content pad24">
                                        <div class="mb20"><h3 class="medium title">MIS DATOS</h3></div>  
                                        <table class="responsive-table striped" border="0">
                                            <tbody>
                                                <?php if ($_SESSION['tipo'] == 'usuario') { ?>
                                                    <tr>
                                                        <td>Código:</td>
                                                        <td><input type="text" name="txtCodigo" value="<?= $codigo ?>" disabled/></td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td>Rut:</td>
                                                    <td><input type="text" name="txtRut" value="<?= $rut ?>" disabled/></td>
                                                </tr>
                                                <tr>
                                                    <td>Nombre:</td>
                                                    <td><input type="text" name="txtNombre" value="<?= $nombre ?>" disabled/></td>
                                                </tr>
                                                <tr>
                                                    <td>Perfil:</td>
                                                    <td><input type="text" name="txtPerfil" value="<?= $perfil ?>" disabled/></td>
                                                </tr>
                                                <tr>
                                                    <td>Estado:</td>
                                                    <td><input type="text" name="txtEstado" value="<?= $estado ?>" disabled/></td>
                                                </tr> 
                                                <?php if ($_SESSION['tipo'] == 'usuario') { ?>
                                                    <tr>
                                                        <td>Direccion:</td>
                                                        <td><input type="text" name="txtDireccion" value="<?= $direccion ?>" disabled/></td>      
                                                    </tr>
                                                    <?php if ($usuario->getPerfil() == 'Particular') { ?>
                                                        <tr>   
                                                            <td>Email:</td>
                                                            <td><input type="text" name="txtEmail" value="<?= $email ?>" disabled/></td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="ventanaTelefonos.php">Telefonos</a></td>
                                                        <?php } else { ?>   
                                                            <td><a href="ventanaContactos.php">Contactos</a></td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php if ($_SESSION['tipo'] == 'usuario') { ?>
                                        <form method="POST">
                                            <input type="submit" name="accion" value="Dar de baja">
                                        </form>
                                        <br>
                                    <?php } ?>
                                    <a href="ventanaEditarMisDatos.php">Editar</a>
                                    <a href=../login/volver.php>Volver</a> <br>
                                    <br>
                                </div>
                            </div>
                        </div>   
                    </div>
                </div>
                </div>
            </section>
        </main>
    </body>
</html>
