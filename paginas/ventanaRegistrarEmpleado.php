<?php
include_once '../login/sessionStart.php';
include_once './perfilesEmpleados.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../static/css/postulacion.css" type="text/css"/>
        <meta charset="UTF-8">
        <title>Registro Empleado</title>
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
                                        <div class="mb20"><h3 class="medium title">Registro de Empleados</h3></div> 
                                        <form action="registrarEmpleado.php" method="POST">
                                            <table>
                                                <tr>
                                                    <td>Categoría:</td>
                                                    <td><select name="cmbCategoria">
                                                            <?php selectPerfilesEmpleados($categoria); ?>
                                                        </select></td>
                                                </tr>
                                                <tr>
                                                    <td>Rut:</td>
                                                    <td><input type="text" name="txtRut" value="" required="true"/></td>
                                                </tr>
                                                <tr>
                                                    <td>Nombre:</td>
                                                    <td><input type="text" name="txtNombre" value="" required="true"/></td>
                                                </tr>
                                                <tr>
                                                    <td>Password</td>
                                                    <td><input type="password" name="txtPassword" value="" required="true" /></td>
                                                </tr>
                                                <tr>
                                                    <td>Repetir Password</td>
                                                    <td><input type="password" name="txtPassword2" value="" required="true" /></td>
                                                </tr>
                                            </table>
                                            <br>
                                            <input type="submit" value="Guardar" name="btnGuardar" />
                                            <br>
                                            <a href=../login/volver.php>Volver</a> <br>
                                        </form>
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
