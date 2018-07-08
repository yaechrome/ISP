<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
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
        <form action="busquedaMuestras.php" method="POST" class="container-formulario">
            <div class="elemento-formulario ancho">
                <input type="text" name="txtCodigoMuestra" value="" placeholder="Código muestra"/>
                <input type="submit" value="Buscar" name="btnBuscar" />
            </div>
            <div class="grid-wrapper elemento-formulario ancho">
                <div>Código Muestra</div>
                <div>Estado</div>
                <?php
                    for ($x = 0; $x <= 10; $x++) {
                        ?>
                            <div>123</div>
                            <div>Procesado</div>
                        <?php
                    }
                ?>
            </div>
                
        </form>
    </body>
</html>
