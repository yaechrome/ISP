<?php


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
            <input type="text" name="txtId" value="" />
            <input type="submit" value="Buscar" name="btnBuscar" />
        </form>
        <br>
        <div class="grilla">
            <div class="header">ID</div>
            <div class="header">Nombre</div>
            <div class="header"></div>
            <?php
                    for ($x = 0; $x <= 10; $x++) {
                        ?>
                            <div>123</div>
                            <div>456</div>
                            <div><input type="button" value="Eliminar" name="btnEliminar" /></div>
                        <?php
                    }
                ?>
        </div>
        <a href="ventanaCrearTipoAnalisis.php">Crear</a>
        <a href=../login/volver.php>Volver</a> <br>
    </body>
</html>
