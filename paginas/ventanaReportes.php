<?php

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
$reporteTecnicos= (new ResultadoAnalisisDaoImp())->reporteAnalisisXTecnico();
$htmlReporteTecnicos= implode(array_map($htmlDeUnReporte, iterator_to_array($reporteTecnicos)));

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Reportes</title>
        <style>
            .container-busquedas {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around;
            }
            .container-busquedas2 {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }
            .busqueda {
                width: 50%;
                min-width: 300px;
            }
            .grilla {
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                grid-gap: 10px;
            }
            .header {
                border-bottom: 1px solid #000;
            }
        </style>
    </head>
    <body>
        <h1>Reporte Receptores</h1>
        <div class="grilla">
            <div class="header">Rut</div>
            <div class="header">Nombre</div>
            <div class="header">Cantidad</div>
            <?= $htmlReporteReceptores ?>
        </div>

        <h1>Reporte Técnicos</h1>
        <div class="grilla">
            <div class="header">Rut</div>
            <div class="header">Nombre</div>
            <div class="header">Cantidad</div>
            <?= $htmlReporteTecnicos ?>
        </div>
        <a href=../login/volver.php>Volver</a> <br>
    </body>
</html>
