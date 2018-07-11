<?php
include_once '../login/sessionStart.php';
include_once '../dto/AnalisisMuestras.php';
include_once '../dto/ResultadoAnalisis.php';

$fechaRecepcion = trim($_POST['txtFecha']);
$temperaturaRecepcion = trim($_POST['txtTemperatura']);
$cantidadMuestra = trim($_POST['txtCantidad']);
$cliente = $_SESSION["cliente"];
$empleado = $_SESSION["usuario"];





