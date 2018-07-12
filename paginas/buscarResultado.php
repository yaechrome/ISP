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
} else {
    $daoR = new ResultadoAnalisisDaoImp();
    $lista = $daoR->listarPorIdAnalisisMuestra($id);

    include('./ventanaResultadoAnalisis.php?data=' . json_encode($lista));
}


