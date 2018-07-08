<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
     <head>
        <meta charset="UTF-8">
        <title>Registro Cliente Empresa</title>
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
        <form action="registroClienteEmpresa.php" method="POST" class="container-formulario">
            <div class="container-seccion">
                <h1>Registrarse</h1>
            <input type="text" name="txtRut" value="" class="elemento-seccion" placeholder="Rut" required="true"/>
            <input type="text" name="txtNombre" value="" class="elemento-seccion" placeholder="Nombre" required="true"/>
            <input type="text" name="txtDireccion" value="" class="elemento-seccion" placeholder="Direccion" required="true"/>
            <input type="password" name="txtPassword" value="" class="elemento-seccion" placeholder="Password" required="true"/>
            
            <div class="elemento-seccion"><input type="checkbox" name="chkTerminos" value="ON"/>Acepto los términos</div>
            <input type="submit" value="Registrarse" name="btnRegistrarse" class="elemento-seccion" />
        </div>
        </form>
    </body>
</html>
