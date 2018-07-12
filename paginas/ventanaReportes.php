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
        <link rel="stylesheet" href="../static/css/postulacion.css" type="text/css"/>
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
                                label: 'Cantidad de muestras recibidas',
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
                                label: 'Cantidad de muestras procesadas',
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
        <main role="main">
            <section class="container">
                <div class="row mb0 center-align relative full">
                    <div class="center">
                        <div class="card">
                            <div class="card-panel pad0">
                                <div class="card-content pad24">
                                    <div class="mb20"><h3 class="medium title">Reporte Receptores</h3></div>  
                                    <div class="container-formulario">
                                        <canvas id="myChart" width="450" height="325" class="elemento-formulario"></canvas>
                                        <div class="grilla">
                                            <div class="header">Rut</div>
                                            <div class="header">Nombre</div>
                                            <div class="header">Cantidad</div>
                                            <?= $htmlReporteReceptores ?>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="mb20"><h3 class="medium title">Reporte Técnicos</h3></div> 
                                    <div class="container-formulario">
                                        <canvas id="tecnicos" width="450" height="325" class="elemento-formulario"></canvas>
                                        <div class="grilla">
                                            <div class="header">Rut</div>
                                            <div class="header">Nombre</div>
                                            <div class="header">Cantidad</div>
                                            <?= $htmlReporteTecnicos ?>
                                        </div>
                                    </div>
                                    <br>
                                    <h3 class="medium title"><a href=../login/volver.php>Volver</a></h3> <br>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
