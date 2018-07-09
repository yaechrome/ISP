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
        <form action="registroMuestras.php" method="POST" class="container-formulario">
            <div class="elemento-formulario delgado">
                Código del Cliente: 
            </div>
            <div class="elemento-formulario delgado">
                Código de la muestra: 
            </div>
            <div class="elemento-formulario ancho grid-wrapper">
                <div>Tipo análisis</div>
                <div>PPM de la muestra</div>
                <?php
                    for ($x = 0; $x <= 10; $x++) {
                        ?>
                            <div>Micotoxinas</div>
                            <div><input type="text" name="txtMuestra" value="" /></div>
                        <?php
                    }
                ?>
            </div>
            <input type="submit" value="Guardar Análisis" name="btnGuardar" class="elemento-formulario"/>
        </form>
        <a href=../login/volver.php>Volver</a> <br>
    </body>
</html>
