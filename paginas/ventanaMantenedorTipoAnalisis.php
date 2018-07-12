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
        <link rel="stylesheet" href="../static/css/postulacion.css" type="text/css"/>
        <meta charset="UTF-8">
        <title>Mantenedor Tipo Analisis</title>
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
                                        <div class="mb20"><h3 class="medium title">Mantenedor de Tipo Analisis</h3></div>  
                                        <form action="mantenedorTipoAnalisis.php" method="POST" class="container-busquedas">
                                            <table>
                                                <tr>
                                                    <td>ID</td>
                                                    <td><input type="number" name="txtId" value="" /></td>
                                                    <td><input type="submit" value="Buscar" name="btnBuscar" /></td>
                                                </tr>
                                            </table>
                                        </form>
                                        <form method="GET" class="container-busquedas">
                                            <br>
                                            <input type="submit" value="Listar Todos" name="btnListarTodos" />
                                        </form>
                                        <br>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <td class="black-text">ID</td>
                                                    <td class="black-text">Nombre</td>                                         
                                                    <td class="black-text">Accion</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include_once '../dto/TipoAnalisis.php';
                                                foreach ($lista as $dto) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $dto->getId(); ?></td>
                                                        <td><?php echo $dto->getNombre(); ?></td>
                                                        <td><a href="eliminarTipoAnalisis.php?id=<?php echo $dto->getId(); ?>">Eliminar</a></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <a href="ventanaCrearTipoAnalisis.php">Crear</a>
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
