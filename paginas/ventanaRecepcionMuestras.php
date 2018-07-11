<?php
include_once '../dto/Usuario.php';
include_once '../dto/TipoAnalisis.php';
include_once '../login/sessionStart.php';

$usuario = $_SESSION["cliente"];
?>
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
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script>
            window.onload = function () {
                var vm = new Vue({
                    el: '#sel',
                    data: {
                        analisis: []
                    },
                    methods: {
                        agregar: function () {
                            var e = document.getElementById("tipo");
                            var str = e.options[e.selectedIndex].text;
                            var id = e.value;
                            var tipo = {
                                id: id,
                                nombre: str
                            }

                            const elemento_que_ya_estaba = this.analisis.find((tipo) => tipo.id == id);
                            const no_esta = elemento_que_ya_estaba == undefined;
                            if (no_esta) {
                                this.analisis.push(tipo);
                            }
                            const texto = this.analisis
                                    .map((q) => q.nombre)
                                    .join(", ");

                            document.getElementById('myText').value = texto;
                            document.getElementById('analisisJson').value = JSON.stringify(this.analisis);
                        }
                    }

                });
            };
        </script>
    </head>
    <body>
        <h1>Recepción de muestras</h1>
        <form id="sel" action="recepcionMuestras.php" method="POST" class="container-formulario">
            <div class="elemento-formulario delgado container-seccion">
                <input type="text" name="txtCodigo" value="<?= $usuario->getCodigo() ?>" disabled="true" class="elemento-seccion"/>
                <input type="text" name="txtRut" value="<?= $usuario->getRut() ?>" disabled="true" class="elemento-seccion"/>
                <input type="text" name="txtNombre" value="<?= $usuario->getNombre() ?>" disabled="true" class="elemento-seccion"/>  
            </div>
            <div class="elemento-formulario delgado container-seccion">
                <div class="elemento-seccion">Fecha de recepción</div>
                <input type="date" name="txtFecha" value="" class="elemento-seccion" required/>
                <input type="number" name="txtTemperatura" value="" placeholder="Temperatura muestra" class="elemento-seccion" required/>
                <input type="number" name="txtCantidad" value="" placeholder="Cantidad de Muestra" class="elemento-seccion" required/>
            </div>
            <div class="elemento-formulario ancho container-seccion">
                <div class="elemento-seccion">Tipo de análisis a realizar</div>
                <select id="tipo" name="cmbTipoAnalisis" class="elemento-seccion">
                    <?php
                    include_once '../dao/TipoAnalisisDaoImp.php';
                    foreach (TipoAnalisisDaoImp::listar() as $value) {
                        ?>
                        <option value="<?= $value->getId() ?>"><?= $value->getNombre() ?></option>                                
                    <?php } ?>
                </select>
                <input type="button" value="Agregar" name="btnAgregar" class="elemento-seccion" v-on:Click="agregar" />
                <textarea id="myText" name="txtSalida" class="elemento-seccion" required>
                </textarea>
                <input id="analisisJson" type="hidden" value="[]" name="analisisJson">
                <input type="submit" value="Guardar" name="btnGuardar" class="elemento-seccion"/>
            </div>
        </form>
        <a href=../login/volver.php>Volver</a> <br>
    </body>
</html>
