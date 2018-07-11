<?php
include_once '../dto/Empleado.php';
include_once '../dao/EmpleadoDaoImp.php';
include_once '../login/sessionStart.php';

$dao = new EmpleadoDaoImp();
$rut = trim($_POST["txtRut"]);
$nombre = trim($_POST["txtNombre"]);
$contrasena = trim($_POST["txtPassword"]);
$contrasena2 = trim($_POST["txtPassword2"]);
$categoria = $_POST["cmbCategoria"];

$mensaje = null;

$buscar= $dao->existeRegistro($rut);
    if($buscar){
        $mensaje= "Empleado ya existe";
    }else{
        
        if($contrasena!=$contrasena2){
            $mensaje= "Contraseña no coincide";
            
        }else{
            
            $empleado = new Empleado();
            $empleado->setRut($rut);
            $empleado->setNombre($nombre);
            $empleado->setPassword($contrasena);
            $empleado->setCategoria($categoria);
            
            if($dao->crear($empleado)){
                $mensaje= "Empleado registrado con exito";
            }else{
                $mensaje= "Error al intentar registrar a empleado";
            }
        }
    } 
echo "<script> alert('$mensaje') </script>";

include_once '../login/panel-control.php';