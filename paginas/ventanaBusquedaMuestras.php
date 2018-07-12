<?php
include_once '../dto/Usuario.php';
include_once '../dao/UsuarioDaoImp.php';
include_once '../dao/AnalisisMuestraDaoImp.php';
include_once '../dto/AnalisisMuestras.php';
include_once '../dto/ResultadoAnalisis.php';
include_once '../dao/ResultadoAnalisisDaoImp.php';
include_once '../dto/Empleado.php';
include_once '../login/sessionStart.php';


$usuario = $_SESSION["usuario"];

if (isset($_GET['firstLoad'])) {

    $dao = new AnalisisMuestraDaoImp();
    if ($_SESSION['tipo'] == 'usuario') {
        $codigo = $usuario->getCodigo();
        $_SESSION["busquedaMuestas"] = $dao->buscarPorCodigoCliente($codigo);
    } else {
        $codigo = $usuario->getRut();
        if ($usuario->getCategoria() == 'R') {
            $_SESSION["busquedaMuestas"] = $dao->buscarPorRutReceptor($codigo);
        }
        if ($usuario->getCategoria() == 'T') {
            $daoResultado = new ResultadoAnalisisDaoImp();
            $_SESSION["busquedaMuestas"] = $daoResultado->buscarAnalisisPorTecnico($codigo);
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../static/css/postulacion.css" type="text/css"/>
        <title></title>
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
                                        <form action="busquedaMuestras.php" method="POST" class="container-formulario">
                                            <div class="elemento-formulario ancho">
                                                <input type="number" name="txtCodigoMuestra" value="" placeholder="Código muestra" required/>
                                                <input type="submit" value="Buscar" name="btnBuscar" />
                                                <input type="button" value="Listar Todos" name="btnRecargar" onclick="window.location.href = 'ventanaBusquedaMuestras.php?firstLoad=true'" />
                                            </div>
                                            <br>
                                            <br>
                                            <div>Código Muestra</div>
                                            <table class="responsive-table striped" border="0">
                                                <tbody>
                                                    <tr>
                                                        <td>Estado</td>
                                                    </tr>
                                                    <tr>
                                                        <?php
                                                        $data = $_SESSION["busquedaMuestas"];

                                                        if (count($data) > 1) {
                                                            foreach ($data as $value) {
                                                                ?>
                                                                <td><a href="ventanaResultadoAnalisis.php?id=<?php echo $value->getId() ?>"><?php echo $value->getId() ?></a></td>
                                                                <td><?php echo $value->getEstado() ?></td>
                                                                <?php
                                                            }
                                                        } elseif (count($data) == 1) {
                                                            if (isset($data)) {
                                                                ?>
                                                                <td><a href="ventanaResultadoAnalisis.php?id=<?php echo $data->getId() ?>"><?php echo $data->getId() ?></a></td>
                                                                <td><?php echo $data->getEstado() ?></td>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <td><?php echo 'Sin datos' ?></td>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <br>
                                            <br>
                                        </form>
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
