<?php
include_once '../login/sessionStart.php';
include_once './perfilesEmpleados.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registro Empleado</title>
        <style>
            .grid-wrapper {
                display: grid;
                grid-template-columns: 50% 50%;
                grid-gap: 10px;
            }
            .container-formulario {
                display: grid;
                grid-template-columns: 100%;
                justify-items: center;
            }

            .elemento-formulario {
                min-width: 300px;
            }
        </style>
    </head>
    <body>
        <form action="registrarEmpleado.php" method="POST">
            <div class="grid-wrapper elemento-formulario">
                <div>Categoría:</div>
                <div><select name="cmbCategoria">
                        <?php selectPerfilesEmpleados($categoria); ?>
                    </select></div>
                <div>Rut:</div>
                <div><input type="text" name="txtRut" value="" required="true"/></div>
                <div>Nombre:</div>
                <div><input type="text" name="txtNombre" value="" required="true"/></div>
                <div>Password</div>
                <div><input type="password" name="txtPassword" value="" required="true" /></div>
                <div>Repetir Password</div>
                <div><input type="password" name="txtPassword2" value="" required="true" /></div>
            </div>
            <input type="submit" value="Guardar" name="btnGuardar" />
            <a href=../login/volver.php>Volver</a> <br>
        </form>

    </body>
</html>
