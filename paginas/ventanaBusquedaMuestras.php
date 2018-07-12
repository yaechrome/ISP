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
        <link rel="stylesheet" href="../static/css/postulacion.css" type="text/css"/>
        <meta charset="UTF-8">
        <title></title>
        <style>
            .grid-wrapper {
                display: grid;
                grid-template-columns: 50% 50%;
                grid-gap: 10px;
            }
            .container-formulario {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }
            .ancho {
                width: 70%;
            }
            .elemento-formulario {
                min-width: 300px;
            }
        </style>
    </head>
    <body>
        <main role="main">
            <section class="container">
                <div class="row mb0 center-align relative full">
                    <div class="center">
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
                                        <div class="grid-wrapper elemento-formulario ancho">
                                            <div>Código Muestra</div>
                                            <div>Estado</div>
                                            <?php
                                            $data = $_SESSION["busquedaMuestas"];
                                            if (count($data) > 0) {
                                                foreach ($data as $value) {
                                                    ?>
                                                    <div><a href="ventanaResultadoAnalisis.php?id=<?php echo $value->getId() ?>"><?php echo $value->getId() ?></a></div>
                                                    <div><?php echo $value->getEstado() ?></div>
                                                    <?php
                                                }
                                            } else {
                                                    ?>
                                                    <div><?php echo 'Sin datos' ?></div>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                        <br>
                                        <br>
                                    </form>
                                    <a href=../login/volver.php>Volver</a> <br>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
