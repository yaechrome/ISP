<?php
include_once '../login/sessionStart.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../static/css/postulacion.css" type="text/css"/>
        <meta charset="UTF-8">
        <title>Crear Tipo de Analisis</title>
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
                                        <div class="mb20"><h3 class="medium title">Crear Tipo Analisis</h3></div>  
                                        <form action="agregarTipoAnalisis.php" method="POST" class="container-busquedas">
                                            <table>
                                                <tr>
                                                    <td>Nombre</td>
                                                    <td><input type="text" name="txtNombre" value="" required/></td>
                                                </tr>
                                            </table
                                            <br>
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
