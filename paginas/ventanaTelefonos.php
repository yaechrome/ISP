<?php
include_once '../dto/Usuario.php';
include_once '../dao/UsuarioDaoImp.php';
include_once '../dto/Telefono.php';
include_once '../dao/TelefonoDaoImp.php';
include_once '../login/sessionStart.php';

$dao = new UsuarioDaoImp();
$usuario = $_SESSION["usuario"];
$codigo = $usuario->getCodigo();	
$telDao = new TelefonoDaoImp();
$listaTelefonos = $telDao->listarPorCodigoParticular($codigo);
	
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <style>
            .grid-wrapper {
                display: grid;
                grid-template-columns: 25% 25%;
                grid-gap: 15px;
            }
           
        </style>
        <h1>Listado de telefonos</h1>
        
        <div class="grid-wrapper">
                <div>Numero de telefono</div>
               
                <div>Acción</div>
                <?php
                    foreach ($listaTelefonos as $value) {  ?>
	
                <div> <?php echo $value->getNumero(); ?> </div>
                <div><a href="eliminarTelefono.php?id=<?php echo $value->getId() ?>">Eliminar</a></div>
                
                <?php    }?>
                <form action="agregarTelefono.php" method="POST">
                    <div><input type="text" name="txtNuevo" value="" required="true" ></div>
                    <div><input type="submit" value="Agregar" name="btnAgregar" /></div>
                </form>
               
        </div>
        
        <br>
         <a href=../login/volver.php>Volver</a> <br>
    </body>
</html>
