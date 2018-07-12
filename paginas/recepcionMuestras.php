<?php

include_once '../login/sessionStart.php';
include_once '../dto/TipoAnalisis.php';
include_once '../dto/AnalisisMuestras.php';
include_once '../dto/ResultadoAnalisis.php';
include_once '../dao/ResultadoAnalisisDaoImp.php';
include_once '../dao/AnalisisMuestraDaoImp.php';
include_once '../login/sessionStart.php';

$fechaRecepcion = trim($_POST['txtFecha']);
$temperaturaRecepcion = trim($_POST['txtTemperatura']) + 0.0;
$cantidadMuestra = trim($_POST['txtCantidad']);
$cliente = $_SESSION["cliente"];
$empleado = $_SESSION["usuario"];

$muestra = new AnalisisMuestras();
$muestra->setTemperaturaRecepcion($temperaturaRecepcion);
$muestra->setCantidadMuestra($cantidadMuestra);
$muestra->setUsuario($cliente);
$muestra->setEmpleado($empleado);

$daoMuestra = new AnalisisMuestraDaoImp();
$daoResultado = new ResultadoAnalisisDaoImp();
$idMuestra = $daoMuestra->crear($muestra);

if ($idMuestra == 0) {
    $mensaje = "No se pudo crear la muestra";
} else {
    $muestra->setId($idMuestra);
    $analisises = json_decode($_POST['analisisJson']);
    foreach ($analisises as $analisis) {
        $id = $analisis->id;
        $nombre = $analisis->nombre;
        $tipo = new TipoAnalisis();
        $tipo->setId($id);
        $tipo->setNombre($nombre);
        $dto = new ResultadoAnalisis();
        $dto->setTipoAnalisis($tipo);
        $dto->setAnalisisMuestra($muestra);
        $dto->setEmpleado(NULL);
        if($daoResultado->crear($dto)){
            $mensaje = "Se creó correctamente la recepcion de muestras";
        }else{
            $mensaje = "No se pudo crear la recepcion de muestras";
        }
        
    }
}
echo "<script> alert('$mensaje') </script>";

include_once '../login/volver.php';
