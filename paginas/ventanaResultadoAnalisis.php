
<?php
include_once '../login/sessionStart.php';
include_once '../dao/ResultadoAnalisisDaoImp.php';
include_once '../dto/ResultadoAnalisis.php';
include_once '../dao/AnalisisMuestraDaoImp.php';
include_once '../dto/AnalisisMuestras.php';

$id = $_GET["id"];

$daoA = new AnalisisMuestraDaoImp();
$analisis = $daoA->buscarPorClavePrimaria($id);
$est = $analisis->getEstado();
if ($est == 'En Proceso') {
    echo "<script> alert('Analisis sin resultado') </script>";
    include_once '../login/panel-control.php';
    exit();
}


$daoR = new ResultadoAnalisisDaoImp();
$lista = iterator_to_array($daoR->listarPorIdAnalisisMuestra($id));

$htmlDeUnResultado = function ($resultado) {
    $nombre = $resultado->getTipoAnalisis()->getNombre();
    $ppm = $resultado->getPpm();
    return <<<HTML
        <div>$nombre</div>
        <div>$ppm</div>
HTML;
};
$htmlDeTodosLosResultados = implode(array_map($htmlDeUnResultado, $lista));


$nombreDeUnResultado = function ($resultado) {
    return '"' . $resultado->getTipoAnalisis()->getNombre() . '"';
};
$nombresDeLasEtiquetas = implode(', ', array_map($nombreDeUnResultado, $lista));


$ppmDeUnResultado = function ($resultado) {
    return $resultado->getPpm();
};
$alturaDeLasBarras = implode(', ', array_map($ppmDeUnResultado, $lista));
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Resultado de muestras</title>
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
            #myChart {

            }
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.js"></script>
        <script>
            window.onload = function () {
                var ctx = document.getElementById("myChart");
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [<?= $nombresDeLasEtiquetas ?>],
                        datasets: [{
                                label: 'PPM del análisis',
                                data: [<?= $alturaDeLasBarras ?>],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                    },
                    options: {
                        responsive: false,
                        scales: {
                            xAxes: [
                                {
                                    ticks: {
                                        maxRotation: 90,
                                        minRotation: 80
                                    }
                                }
                            ],
                            yAxes: [
                                {
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }
                            ]
                        }
                    }
                });
            };
        </script>
    </head>
    <body>
        <form action="resultadoAnalisis.php" method="POST" class="container-formulario">
            <canvas id="myChart" width="600" height="500" class="elemento-formulario"></canvas>
            <div class="grid-wrapper elemento-formulario">
                <div>Tipo de análisis</div>
                <div>Resultado en PPM</div>
                <?= $htmlDeTodosLosResultados ?>
            </div>
        </form>
        <a href=../login/volver.php>Volver</a> <br>
    </body>
</html>
