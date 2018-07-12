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
                                        <form action="editarMisDatos.php" method="POST">
                                            <table class="responsive-table striped" border="0">
                                                <tbody>
                                                    <tr>
                                                        <td>Rut:</td>
                                                        <td><input type="text" name="txtRut" value="<?= $rut ?>" disabled/></td>
                                                    </tr>
                                                    <tr>                                            
                                                        <td>Nombre:</td>
                                                        <td><input type="text" name="txtNombre" value="<?= $nombre ?>" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Perfil:</td>
                                                        <?php if ($_SESSION['tipo'] == 'empleado' && $usuario->getCategoria() == 'A') { ?>
                                                            <td><select name="cmbPerfil">
                                                                    <?php selectPerfilesEmpleados($categoria); ?>
                                                                </select></td>
                                                        <?php } else { ?>
                                                            <td><input type="text" name="txtPerfil" value="<?= $perfil ?>" disabled/></td>
                                                        <?php } ?>                                                   </tr>
                                                    <tr>
                                                        <td>Estado:</td>
                                                        <td><input type="text" name="txtEstado" value="<?= $estado ?>" /></td>
                                                    </tr> 
                                                    <?php if ($_SESSION['tipo'] == 'usuario') { ?>
                                                        <tr>
                                                            <td>Direccion:</td>
                                                            <td><input type="text" name="txtDireccion" value="<?= $direccion ?>" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email:</td>
                                                            <td><input type="text" name="txtEmail" value="<?= $email ?>" /></td>
                                                        </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <td>Password:</td>
                                                        <td><input type="password" name="txtPassword" value="<?= $password ?>" /></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <br>
                                            <input type="submit" value="Guardar" name="btnGuardar" />
                                        </form>
                                        <br>
                                        <a href=../login/volver.php>Volver</a> <br>
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
