<?php
// put your code here
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Crear Tipo de Analisis</title>
        <style>
            .container-busquedas {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around;
            }
            .grilla {
                display: grid;
                grid-template-columns: 50% 50%;
                grid-gap: 10px;
            }
            .header {
                border-bottom: 1px solid #000;
            }
        </style>
    </head>
    <body>
        <h1>Crear Tipo Analisis</h1>
        <form action="agregarTipoAnalisis.php" method="POST" class="container-busquedas">
            <div class="grilla">
                <div>Nombre</div>
                <div><input type="text" name="txtNombre" value="" required/></div>
                <input type="submit" value="Guardar" name="btnGuardar" />
            </div>  
        </form>
        <a href=../login/volver.php>Volver</a> <br>
    </body>
</html>
