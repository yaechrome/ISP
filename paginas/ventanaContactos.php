<?php
include_once '../dto/Usuario.php';
include_once '../dao/UsuarioDaoImp.php';
include_once '../dto/Contacto.php';
include_once '../dao/ContactoDaoImp.php';
include_once '../login/sessionStart.php';


$usuario = $_SESSION["usuario"];
$codigo = $usuario->getCodigo();
$conDao = new ContactoDaoImp();
$listaContactos = $conDao->listarPorCodigoEmpresa($codigo);
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../static/css/postulacion.css" type="text/css"/>
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
        <main role="main">
            <section class="container">
                <div class="row mb0 center-align relative full">
                    <div class="center">
                        <div class="card">
                            <div class="card-panel pad0">
                                <div class="card-content pad24">
                                    <div class="mb20"><h3 class="medium title black-text ">Listado de Contactos</h3></div>  


                                    <div class="grid-wrapper text_left">
                                        <div class="black-text">Rut</div>
                                        <div class="black-text">Nombre</div>
                                        <div class="black-text">Email</div>
                                        <div class="black-text">Telefono</div>
                                        <div class="black-text">Acción</div>
                                        <?php foreach ($listaContactos as $value) { ?>

                                            <div> <?php echo $value->getRut(); ?> </div>
                                            <div> <?php echo $value->getNombre(); ?> </div>
                                            <div> <?php echo $value->getEmail(); ?> </div>
                                            <div> <?php echo $value->getTelefono(); ?> </div>

                                            <div><a href="eliminarContacto.php?rut=<?php echo $value->getRut() ?>">Eliminar</a></div>

                                        <?php } ?>

                                    </div>      
                                    <br
                                        <div><a href="ventanaAgregarContacto.php">Agregar Contacto</a></div>
                                    <a href=../login/volver.php>Volver</a> <br>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
