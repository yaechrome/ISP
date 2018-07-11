<?php 
include_once '../dto/Usuario.php';
include_once '../dao/UsuarioDaoImp.php';
include_once '../dto/Contacto.php';
include_once '../dao/ContactoDaoImp.php';
include_once '../login/sessionStart.php';

$dao = new UsuarioDaoImp();
$usuario = $_SESSION["usuario"];
$codigo = $usuario->getCodigo();	
$conDao = new ContactoDaoImp();
$listaContactos = $conDao->listarPorCodigoEmpresa($codigo);
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
                grid-template-columns: 20% 20% 20% 20% 20%;
                grid-gap: 15px;
            }
           
        </style>
        <h1>Listado de Contactos</h1>
        
        <div class="grid-wrapper">
                <div>Rut</div>
                <div>Nombre</div>
                <div>Email</div>
                <div>Telefono</div>
                <div>Acción</div>
                <?php
                    foreach ($listaContactos as $value) {  ?>
	
                <div> <?php echo $value->getRut(); ?> </div>
                <div> <?php echo $value->getNombre(); ?> </div>
                <div> <?php echo $value->getEmail(); ?> </div>
                <div> <?php echo $value->getTelefono(); ?> </div>
            
                <div><a href="eliminarContacto.php?rut=<?php echo $value->getRut() ?>">Eliminar</a></div>
                
                <?php    }?>
               
        </div>      
        
        <div><a href="ventanaAgregarContacto.php">Agregar Contacto</a></div>
             
        <br>
         <a href=../login/volver.php>Volver</a> <br>
    </body>
</html>
