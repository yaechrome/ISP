<?php

include_once '../dto/Usuario.php';
include_once '../dao/UsuarioDaoImp.php';

$dao = new UsuarioDaoImp();
$rut = trim($_POST["txtRut"]);
$nombre = trim($_POST["txtNombre"]);
$email = trim($_POST["txtEmail"]);
$telefono = trim($_POST["txtTelefono"]);
$direccion = trim($_POST["txtDireccion"]);
$contrasena1 = trim($_POST["txtPassword"]);
$contrasena2 = trim($_POST["txtPassword2"]);
$mensaje = null;


    $buscar= $dao->existeRegistro($rut);
    if($buscar){
        $mensaje= "Usuario ya existe";
    }else{
        
        if($contrasena1!=$contrasena2){
            $mensaje= "Contraseña no coincide";
            
        }else{
            
            $usuario = new Usuario();
            $usuario->setRut($rut);
            $usuario->setNombre($nombre);
            $usuario->setEmail($email);
            $usuario->setDireccion($direccion);
            $usuario->setPassword($contrasena1);
            $usuario->setPerfil("Particular"); 
            
            if($dao->crear($usuario)){
                $mensaje= "Usuario registrado con exito";
               
//                $usuario2 = $dao->buscarPorRutCliente($rut);
//                $telefonoDto = new Telefono();
//                $telefonoDto->setNumero($telefono);
//                $telefonoDto->setParticular($usuario2);
//                $telefonoDao = new TelefonoDaoImp();
//                $telefonoDao->crear($telefonoDto);
                
                 echo "<script> alert('$mensaje') </script>";
            }else{
                $mensaje= "Error al intentar registrar usuario";
                echo "<script> alert('$mensaje') </script>";
            }
        }
    }
    
include_once './ventanaRegistroCliente.php';

//include_once '../login/Registrarse.php';