<?php 
include_once '../login/sessionStart.php';
?>
<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" href="../static/css/postulacion.css" type="text/css"/>
        <meta charset="UTF-8">
        <title></title>
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
                                        <div class="mb20"><h3 class="medium title">AGREGAR CONTACTO</h3></div>  
                                        <form action="agregarContacto.php" method="POST">
                                            <table class="responsive-table striped" border="0">
                                                <tbody>
                                                    <tr>
                                                        <td>Rut: </td>
                                                        <td><input type="text" name="txtRut" value="" required="true"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nombre: </td>
                                                        <td><input type="text" name="txtNombre" value="" required="true"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email: </td>
                                                        <td><input type="text" name="txtEmail" value="" required="true"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Telefono:</td>
                                                        <td><input type="text" name="txtTelefono" value="" required="true"/></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <br>
                                            <input type="submit" value="Guardar" name="btnGuardar" />
                                        </form>
                                        <br>
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
