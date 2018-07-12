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
                        <div class="col s12 m6 offset-m3 l4 offset-l4">
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
                                            <input type="submit" value="Guardar Análisis" name="btnGuardar" class="elemento-formulario"/>
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
