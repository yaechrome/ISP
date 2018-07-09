<?php
session_start();
$usuarioLogeado = $_SESSION["usuario"];
include_once '../dto/AnalisisMuestras.php';
include_once '../dto/ResultadoAnalisis.php';

$fechaRecepcion = trim($_POST['txtFecha']);
$temperaturaRecepcion = trim($_POST['txtTemperatura']);
$cantidadMuestra = trim($_POST['txtCantidad']);
$usuario = $usuarioLogeado;
//por mientras no entiendo muy bien cual es el usuario
$empleado = 123;





