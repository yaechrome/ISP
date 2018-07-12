<?php
include_once '../dao/TipoAnalisisDaoImp.php';
include_once '../login/sessionStart.php';

$cantidad = 0;
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $dao = new TipoAnalisisDaoImp();
    $lista = $dao->listar();
    $_SESSION["listaDesplegar"] = $lista;
} else {
    $lista = $_SESSION["listaDesplegar"];
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mantenedor Tipo Analisis</title>
        <style>
            .container-busquedas {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }
            .grilla {
                display: grid;
                grid-template-columns: 4fr 4fr 2fr;
                grid-gap: 10px;
            }
            .header {
                border-bottom: 1px solid #000;
            }
        </style>
    </head>
    <body>
        <h1>Mantenedor de Tipo Analisis</h1>
        <form action="mantenedorTipoAnalisis.php" method="POST" class="container-busquedas">
            <div>ID</div>
            <input type="number" name="txtId" value="" />
            <input type="submit" value="Buscar" name="btnBuscar" />
        </form>
        <form method="GET" class="container-busquedas">
            <input type="submit" value="Listar Todos" name="btnListarTodos" />
        </form>
        <br>
        <div class="grilla">
            <div class="header">ID</div>
            <div class="header">Nombre</div>
            <div class="header"></div>
            <?php
            include_once '../dto/TipoAnalisis.php';
            foreach ($lista as $dto) {
                ?>
                <div><?php echo $dto->getId(); ?></div>
                <div><?php echo $dto->getNombre(); ?></div>
                <a href="eliminarTipoAnalisis.php?id=<?php echo $dto->getId(); ?>">Eliminar</a>

            <?php } ?>
        </div>
        <a href="ventanaCrearTipoAnalisis.php">Crear</a>
        <a href=../login/volver.php>Volver</a> <br>
    </body>
</html>
