<?php
include_once '../dto/Usuario.php';
include_once '../dao/UsuarioDaoImp.php';
include_once '../dto/Telefono.php';
include_once '../dao/TelefonoDaoImp.php';
include_once '../login/sessionStart.php';

$dao = new UsuarioDaoImp();
$usuario = $_SESSION["usuario"];
$codigo = $usuario->getCodigo();
$telDao = new TelefonoDaoImp();
$listaTelefonos = $telDao->listarPorCodigoParticular($codigo);
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../static/css/postulacion.css" type="text/css"/>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <style>
            .grid-wrapper {
                display: grid;
                grid-template-columns: 25% 25%;
                grid-gap: 15px;
            }

        </style>
        <main role="main">
            <section class="container">
                <div class="row mb0 center-align relative full">
                    <div class="center">
                        <div class="col s12 m6 offset-m3 l4 offset-l4">
                            <div class="card">
                                <div class="card-panel pad0">
                                    <div class="card-content pad24">
                                        <div class="mb20"><h3 class="medium title">Listado de telefonos</h3></div>  

                                        <table>
                                            <thead>
                                                <tr>
                                                    <td>Numero de telefono</td>
                                                    <td>Acción</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($listaTelefonos as $value) { ?>
                                                    <tr>
                                                        <td> <?php echo $value->getNumero(); ?> </td>
                                                        <td><a href="eliminarTelefono.php?id=<?php echo $value->getId() ?>">Eliminar</a></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <br>
                                        <form action="agregarTelefono.php" method="POST">
                                            <div><input type="text" name="txtNuevo" value="" required="true" ></div>
                                            <br>
                                            <div><input type="submit" value="Agregar" name="btnAgregar" /></div>
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
