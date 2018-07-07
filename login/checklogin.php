<?php
session_start();
?>

<?php
include_once '../dto/Usuario.php';
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
 
$sql = "SELECT * FROM usuario WHERE rut = '$username' and password = '$password' and estado ='Activo' ";

$result = $conexion->query($sql);


if ($result->num_rows > 0) {     
 
 $row = $result->fetch_array(MYSQLI_ASSOC);
    $usuario = new Usuario();
    $usuario->setCodigo($row['codigo']);
    $usuario->setRut($row['rut']);
    $usuario->setNombre($row['nombre']);
    $usuario->setPassword($row['password']);
    $usuario->setDireccion($row['direccion']);  
    $usuario->setEmail($row['email']);
    $usuario->setPerfil($row['perfil']);
    $usuario->setEstado($row['estado']);

    $_SESSION['usuario'] = $usuario;
    $_SESSION['perfil'] = $row['perfil'];
    $_SESSION['nombre'] = $row['nombre'];

    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);

    
    //echo "<br><br><a href=panel-control.php>Menu</a>"; 
    //header("location:panel-control.php"); 
    include_once '../login/panel-control.php';
 } else { 
   echo "RUT o Password estan incorrectos.";

   echo "<br><a href='login.html'>Volver a Intentarlo</a>";
 }
 mysqli_close($conexion); 
