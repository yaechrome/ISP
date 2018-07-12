<?php
include_once '../dao/AnalisisMuestraDaoImp.php';
include_once '../login/sessionStart.php';


$dao = new AnalisisMuestraDaoImp();
$lista = $dao->buscarEnProceso();
$_SESSION["listaDesplegar"] = $lista;
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../static/css/postulacion.css" type="text/css"/>
        <meta charset="UTF-8">
        <title>Listado de Muestras</title>
        <style>
            .grid-wrapper {
                display: grid;
                grid-template-columns: 34% 34% 32%;
                grid-gap: 10px;
            }
            .header {
                border-bottom: 1px solid #000;
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
                                    <div class="mb20"><h3 class="medium title">Listado de muestras para procesar</h3></div>  
                                    <form action="listadoMuestras.php" method="POST">
                                        <div class="grid-wrapper">
                                            <div class="header">Código Usuario</div>
                                            <div class="header">Código Muestra</div>
                                            <div class="header">Acción</div>
                                            <?php
                                            include_once '../dto/AnalisisMuestras.php';
                                            $data = $_SESSION["listaDesplegar"];
                                            if (count($data) > 0) {
                                                foreach ($data as $dto) {
                                                    ?>
                                                    <div><?php echo $dto->getUsuario()->getCodigo(); ?></div>
                                                    <div><?php echo $dto->getId(); ?></div>
                                                    <a href="ventanaRegistroMuestras.php?id=<?= $dto->getId(); ?>&codigo=<?= $dto->getUsuario()->getCodigo(); ?>">Procesar</a>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="red-text"><?php echo 'Sin muestras para procesar' ?></div>
                                            <?php } ?>
                                        </div>

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