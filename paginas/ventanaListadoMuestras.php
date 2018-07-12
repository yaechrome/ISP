<?php
include_once '../dao/AnalisisMuestraDaoImp.php';
include_once '../login/sessionStart.php';

$cantidad = 0;
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $dao = new AnalisisMuestraDaoImp();
    $lista = $dao->buscarEnProceso();
    $_SESSION["listaDesplegar"] = $lista;
} else {
    $lista = $_SESSION["listaDesplegar"];
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listado de Muestras</title>
        <style>
            .grid-wrapper {
                display: grid;
                grid-template-columns: 34% 34% 32%;
                grid-gap: 10px;
            }
        </style>
    </head>
    <body>
        <h1>Listado de muestras para procesar</h1>
        <form action="listadoMuestras.php" method="POST">
            <div class="grid-wrapper">
                <div>Código Usuario</div>
                <div>Código Muestra</div>
                <div>Acción</div>
                <?php
                include_once '../dto/AnalisisMuestras.php';
            foreach ($lista as $dto) {
                ?>
                <div><?php echo $dto->getUsuario()->getCodigo(); ?></div>
                <div><?php echo $dto->getId(); ?></div>
                <a href="ventanaRegistroMuestras.php?id=<?php echo $dto->getId(); ?>">Procesar</a>
            <?php } ?>
            </div>

        </form>
        <a href=../login/volver.php>Volver</a> <br>
    </body>
</html>