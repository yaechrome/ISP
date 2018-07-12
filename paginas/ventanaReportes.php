<?php
include_once '../login/sessionStart.php';
$htmlDeUnReporte = function ($reporte) {
    $htmlDeUnDato = function ($dato) {
        return "<div>$dato</div>";
    };
    $datos = [
        $reporte->getRut(),
        $reporte->getNombre(),
        $reporte->getCantidad()
    ];
    $htmlsDeLosDatos = array_map($htmlDeUnDato, $datos);
    $htmlDeTodosLosDatos = implode('', $htmlsDeLosDatos);

    return $htmlDeTodosLosDatos;
};

include_once '../dao/AnalisisMuestraDaoImp.php';
$reporteReceptores = (new AnalisisMuestraDaoImp())->reporteRecepcionXReceptor();
$htmlReporteReceptores = implode(array_map($htmlDeUnReporte, iterator_to_array($reporteReceptores)));

include_once '../dao/ResultadoAnalisisDaoImp.php';
$reporteTecnicos = (new ResultadoAnalisisDaoImp())->reporteAnalisisXTecnico();
$htmlReporteTecnicos = implode(array_map($htmlDeUnReporte, iterator_to_array($reporteTecnicos)));


$listaReceptores = iterator_to_array($reporteReceptores);

$nombreDeUnResultado = function ($resultado) {
    return '"' . $resultado->getNombre() . '"';
};
$nombresDeLasEtiquetas = implode(', ', array_map($nombreDeUnResultado, $listaReceptores));


$cantidadDeUnResultado = function ($resultado) {
    return $resultado->getCantidad();
};
$alturaDeLasBarras = implode(', ', array_map($cantidadDeUnResultado, $listaReceptores));



$listaTecnicos = iterator_to_array($reporteTecnicos);

$nombreDeUnResultadoTecnico = function ($resultado) {
    return '"' . $resultado->getNombre() . '"';
};
$nombresDeLasEtiquetasTecnico = implode(', ', array_map($nombreDeUnResultadoTecnico, $listaTecnicos));


$cantidadDeUnResultadoTecnico = function ($resultado) {
    return $resultado->getCantidad();
};
$alturaDeLasBarrasTecnico = implode(', ', array_map($cantidadDeUnResultadoTecnico, $listaTecnicos));


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Reportes</title>
        <style>

            .grilla {
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                grid-gap: 10px;
            }
            .header {
                border-bottom: 1px solid #000;
            }
            .container-formulario {
                display: grid;
                justify-items: center;
            }
            .elemento-formulario {
                min-width: 300px;
            }
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.js"></script>
        <script>
            window.onload = function () {
                var ctx = document.getElementById("myChart");
                var tec = document.getElementById("tecnicos");
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
                new Chart(tec, {
                    type: 'bar',
                    data: {
                        labels: [<?= $nombresDeLasEtiquetasTecnico ?>],
                        datasets: [{
                                label: 'PPM del análisis',
                                data: [<?= $alturaDeLasBarrasTecnico ?>],
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
        <h1>Reporte Receptores</h1>
        <div class="container-formulario">
            <canvas id="myChart" width="550" height="350" class="elemento-formulario"></canvas>
            <div class="grilla">
                <div class="header">Rut</div>
                <div class="header">Nombre</div>
                <div class="header">Cantidad</div>
                <?= $htmlReporteReceptores ?>
            </div>
        </div>


        <h1>Reporte Técnicos</h1>
        <div class="container-formulario">
            <canvas id="tecnicos" width="550" height="350" class="elemento-formulario"></canvas>
            <div class="grilla">
                <div class="header">Rut</div>
                <div class="header">Nombre</div>
                <div class="header">Cantidad</div>
                <?= $htmlReporteTecnicos ?>
            </div>
        </div>
        <a href=../login/volver.php>Volver</a> <br>
    </body>
</html>
