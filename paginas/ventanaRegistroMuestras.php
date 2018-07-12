<?php
include_once '../dao/ResultadoAnalisisDaoImp.php';
include_once '../login/sessionStart.php';


$id = $_GET['id'];
$codigo = $_GET['codigo'];

$dao = new ResultadoAnalisisDaoImp();
$lista = $dao->listarPorIdAnalisisMuestra($id);
$_SESSION["listaDesplegar"] = $lista;
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../static/css/postulacion.css" type="text/css"/>
        <meta charset="UTF-8">
        <title>Registro de Muestras</title>
        <style>
            .grid-wrapper {
                display: grid;
                grid-template-columns: 30% 70%;
                grid-gap: 10px;
            }
            .delgado {
                width: 50%;
            }
            .ancho {
                width: 100%;
            }
            .container-formulario {
                display: flex;
                flex-wrap: wrap;
                justify-content:center;
            }
            .elemento-formulario {
                min-width: 300px;
                align-content: center;
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
                                    <div class="mb20"><h3 class="medium title">Registro de Muestras</h3></div>  

                                    <form action="registroMuestras.php" method="POST" class="container-formulario">
                                        <div class="elemento-formulario delgado">
                                            Código del Cliente: <?= $codigo ?>
                                        </div>
                                        <div class="elemento-formulario delgado">
                                            Código de la muestra: <?= $id ?>
                                        </div>
                                        <div class="elemento-formulario ancho grid-wrapper">
                                            <div>Tipo análisis</div>
                                            <div>PPM de la muestra</div>
                                            <?php
                                            include_once '../dto/ResultadoAnalisis.php';
                                            foreach ($lista as $dto) {
                                                ?>
                                                <div><?php echo $dto->getTipoAnalisis()->getNombre(); ?></div>
                                                <div><input type="number" name="<?= $dto->getTipoAnalisis()->getId() ?>" value="" required/></div>
                                            <?php } ?>

                                        </div>
                                        <input type="hidden" name="txtId" value="<?= $id ?>" />
                                        <div class="container-formulario">
                                            <input type="submit" value="Guardar Análisis" name="btnGuardar" class="elemento-formulario"/>
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
