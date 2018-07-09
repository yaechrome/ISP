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
                    for ($x = 0; $x <= 10; $x++) {
                        ?>
                            <div>123</div>
                            <div>456</div>
                            <div><a href="ventanaRegistroMuestras.php">Procesar</a></div>
                        <?php
                    }
                ?>
            </div>

        </form>
        <a href=../login/volver.php>Volver</a> <br>
    </body>
</html>