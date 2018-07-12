<?php

include_once '../dao/ResultadoAnalisisDaoImp.php';
include_once '../login/sessionStart.php';
include_once '../dto/ResultadoAnalisis.php';
include_once '../dto/TipoAnalisis.php';
include_once '../dao/TipoAnalisisDaoImp.php';
include_once '../dao/AnalisisMuestraDaoImp.php';
include_once '../dto/AnalisisMuestras.php';

$idMuestra = $_POST["txtId"];
$dao = new ResultadoAnalisisDaoImp();
$daoAnalisis = new AnalisisMuestraDaoImp();
$daoTipo = new TipoAnalisisDaoImp();
$tipoAnalisis = new TipoAnalisis();
$analisisMuestra = new AnalisisMuestras();
$analisisMuestra = $daoAnalisis->buscarPorClavePrimaria($idMuestra);
$empleado = $_SESSION['usuario'];


foreach ($_POST as $key => $ppm) {
    if ($key == "txtId") continue;
    if ($key == "btnGuardar") continue;
    $idTipo = $key;
    
    $tipoAnalisis = $daoTipo->buscarPorClavePrimaria($idTipo);
    $dto = new ResultadoAnalisis();
    $dto->setAnalisisMuestra($analisisMuestra);
    $dto->setTipoAnalisis($tipoAnalisis);
    $dto->setEmpleado($empleado);
    $dto->setPpm($ppm);
    if ($dao->modificar($dto)) {
        $mensaje = 'Muestras Procesada con exito';
    } else {
        $mensaje = 'No se pudo procesar las muestras';
    }
}

if ($mensaje == 'Muestras Procesada con exito') {
    $analisisMuestra->setEstado("Terminado");
    if ($daoAnalisis->modificar($analisisMuestra)) {
        $mensaje = 'Muestras Procesada con exito';
    } else {
        $mensaje = 'No se pudo procesar las muestras';
    }
}

if ($mensaje != null) {
    echo "<script> alert('$mensaje') </script>";
}

include_once 'ventanaListadoMuestras.php';
