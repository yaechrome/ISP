<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link rel="stylesheet" href="../static/css/postulacion.css" type="text/css"/>
        <meta charset="UTF-8">
        <title>Registro Cliente</title>
        <style>
            .container-formulario {
                display: flex;
                flex-wrap: wrap;
                justify-content:center;
            }

            .container-seccion {
                display: flex;
                flex-wrap: nowrap;
                flex-direction: column;
                align-items: flex-start;

            }

            .elemento-seccion {
                margin: 2px;

            }
            input[type="button"].elemento-seccion, input[type="submit"].elemento-seccion {
                background-color: #008CBA;
                color: white;
            }
            input.elemento-seccion, select.elemento-seccion {
                border-radius: 5px;
                height: 3em;
            }
        </style>
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
                                        <form action="registroCliente.php" method="POST" class="container-formulario">
                                            <div class="container-seccion">
                                                <div class="mb20"><h3 class="medium title">Registrarse</h3></div>  
                                                <input type="text" name="txtRut" value="" class="elemento-seccion" placeholder="Rut" required="true"/>
                                                <input type="text" name="txtNombre" value="" class="elemento-seccion" placeholder="Nombre" required="true"/>
                                                <input type="password" name="txtPassword" value="" class="elemento-seccion" placeholder="Password" required="true"/>
                                                <input type="password" name="txtPassword2" value="" class="elemento-seccion" placeholder="repetir Password" required="true"/>
                                                <input type="text" name="txtEmail" value="" class="elemento-seccion" placeholder="Email" required="true"/>
                                                <input type="text" name="txtTelefono" value="" class="elemento-seccion" placeholder="Teléfono" required="true"/>
                                                <input type="text" name="txtDireccion" value="" class="elemento-seccion" placeholder="Direccion" required="true"/>
                                                <div class="elemento-seccion"><input type="checkbox" name="chkTerminos" value="ON" required="true"/>Acepto los términos</div>
                                                <input type="submit" value="Registrarse" name="btnRegistrarse" class="elemento-seccion" />
                                            </div>
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
