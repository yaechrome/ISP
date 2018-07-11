<?php 
include_once '../login/sessionStart.php';
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            .grid-wrapper {
                display: grid;
                grid-template-columns: 30% 70% ;
                grid-gap: 10px;
            }
            .elemento-formulario {
                min-width: 300px;
            }
        </style>
    </head>
    <body>
        <h1>Nuevo Contacto</h1>
        <form action="agregarContacto.php" method="POST">
            <div class="grid-wrapper elemento-formulario">
                <div>Rut:</div>
                <div><input type="text" name="txtRut" value="" required="true"/></div>
                <div>Nombre:</div>
                <div><input type="text" name="txtNombre" value="" required="true"/></div>
                <div>Email:</div>
                <div><input type="text" name="txtEmail" value="" required="true"/></div>
                <div>Telefono:</div>
                <div><input type="password" name="txtTelefono" value="" required="true"/></div>
            </div>
            <input type="submit" value="Guardar" name="btnGuardar" />
        </form>
        <a href=../login/volver.php>Volver</a> <br>
    </body>
</html>
