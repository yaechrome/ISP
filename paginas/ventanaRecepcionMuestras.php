<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Recepción de Muestras</title>
        <style>
            .container-formulario {
                display: flex;
                flex-wrap: wrap;
            }

            .elemento-formulario {
                min-width: 300px;
            }

            .delgado {
                width: 50%;
            }

            .ancho {
                width: 70%;
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

            input.elemento-seccion, select.elemento-seccion, textarea.elemento-seccion {
                border-radius: 5px;
                height: 3em;
            }

            input[type="button"].elemento-seccion, input[type="submit"].elemento-seccion {
                background-color: #008CBA;
                color: white;
            }

            input[type="text"].elemento-seccion, input[type="date"].elemento-seccion {
                padding: 0 0 0 10px;
            }

            input:not([type="button"]):not([type="submit"]).elemento-seccion, select.elemento-seccion, textarea.elemento-seccion {
                width: 90%;
            }


        </style>
    </head>
    <body>
        <h1>Recepción de muestras</h1>
        <form action="recepcionMuestras.php" method="POST" class="container-formulario">
            <div class="elemento-formulario delgado container-seccion">
                <input type="text" name="txtCodigo" value="" placeholder="Código Cliente" class="elemento-seccion"/>
                <input type="text" name="txtRut" value="" placeholder="Rut Cliente" class="elemento-seccion"/>
                <input type="text" name="txtNombre" value="" placeholder="Nombre Cliente" class="elemento-seccion"/>  
            </div>
            <div class="elemento-formulario delgado container-seccion">
                <div class="elemento-seccion">Fecha de recepción</div>
                <input type="date" name="txtFecha" value="" class="elemento-seccion"/>
                <input type="text" name="txtTemperatura" value="" placeholder="Temperatura muestra" class="elemento-seccion"/>
                <input type="text" name="txtCantidad" value="" placeholder="Cantidad de Muestra" class="elemento-seccion"/>
            </div>
            <div class="elemento-formulario ancho container-seccion">
                <div class="elemento-seccion">Tipo de análisis a realizar</div>
                <select name="cmbTipoAnalisis" class="elemento-seccion">
                    <option></option>
                </select>
                <input type="button" value="Agregar" name="btnAgregar" class="elemento-seccion"/>
                <textarea name="txtSalida" class="elemento-seccion">
                </textarea>
                <input type="submit" value="Guardar" name="btnGuardar" class="elemento-seccion"/>
            </div>
        </form>
    </body>
</html>
