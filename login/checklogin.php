<?php
include_once '../login/sessionStart.php';
$host_db = "127.0.0.1";
$user_db = "root";
$pass_db = "";
$db_name = "isp";
$tbl_name = "usuario";

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

if ($conexion->connect_error) {
    
        die("La conexion falló: " . $conexion->connect_error);
    
}

$username = $_POST['username'];
$password = $_POST['password'];
 
$sql = "SELECT * FROM usuario WHERE rut = '$username' and password = '$password' ";

$result = $conexion->query($sql);

if ($result->num_rows > 0) {   
    
    $row = $result->fetch_array(MYSQLI_ASSOC);
    
    if($row["estado"]== 'Activo'){
        $usuario = new Usuario();
        $usuario->setCodigo($row['codigo']);
        $usuario->setRut($row['rut']);
        $usuario->setNombre($row['nombre']);
        $usuario->setPassword($row['password']);
        $usuario->setDireccion($row['direccion']);  
        $usuario->setEmail($row['email']);
        $usuario->setPerfil($row['perfil']);
        $usuario->setEstado($row['estado']);

        $_SESSION['tipo'] = 'usuario';
        $_SESSION['usuario'] = $usuario;
        $_SESSION['perfil'] = $row['perfil'];
        $_SESSION['nombre'] = $row['nombre'];

        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['start'] = time();
        $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);

        include_once '../login/panel-control.php';
    }else{
        echo "<script> alert('Usuario inactivo') </script>";
        include_once './Login.html';
    }
 } else { 
    $sql = "SELECT * FROM empleado WHERE rutEmpleado = '$username' and passwordEmpleado = '$password'";

    $result = $conexion->query($sql);
    if($result->num_rows > 0){
       
        $row = $result->fetch_array(MYSQLI_ASSOC);
        
        if($row["Estado"]== 'Activo'){
            $empleado = new Empleado();
            $empleado->setRut($row['rutEmpleado']);
            $empleado->setNombre($row['nombreEmpleado']);
            $empleado->setPassword($row['passwordEmpleado']);
            $empleado->setCategoria($row['categoria']);
            $empleado->setEstado($row['Estado']);

            $_SESSION['tipo'] = 'empleado';
            $_SESSION['usuario'] = $empleado;
            $_SESSION['perfil'] = $row['categoria'];
            $_SESSION['nombre'] = $row['nombreEmpleado'];

            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['start'] = time();
            $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);

            include_once '../login/panel-control.php';
        }else{
            echo "<script> alert('Usuario inactivo') </script>";
            include_once './Login.html';
        }
    }else{
       echo "RUT o Password estan incorrectos.";

       echo "<br><a href='login.html'>Volver a Intentarlo</a>";
    }
 }
 mysqli_close($conexion); 
