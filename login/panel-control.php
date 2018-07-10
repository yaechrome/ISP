<?php
include_once '../dto/Usuario.php';
$is_logged_in = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true;
if (!$is_logged_in) {
    echo "Esta pagina es solo para usuarios registrados.<br>";
    echo "<br><a href='login.html'>Login</a>";

    exit;
}

$now = time();
if ($now > $_SESSION['expire']) {
    session_destroy();

    echo "Su sesion a terminado, <a href='login.html'>Necesita Hacer Login</a>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="../static/css/codebeautify.css" type="text/css"/>
    <div class="text_right">
        <a class="btn red darken-1" href=logout.php>Cerrar Sesion </a>
    </div>
    <title>Menu</title>
</head>
<body>
    <main role="main">
        <section class="container">
            <div class="row mb0 center-align relative full">
                <div class="center">
                    <div class="text_center">
                        <h5 class="small title black-text"><?php echo 'Bienvenido ' . $_SESSION['nombre']; ?></h5>
                    </div>
                    <div class="col s12 m6 offset-m3 l4 offset-l4">
                        <div class="card">
                            <div class="card-panel pad0">
                                <div class="card-content pad24">
                                    <div class="mb20"><h3 class="big header black-text">MENU</h3></div>   
                                    <ul>
                                        <?php if ($_SESSION['tipo'] == 'usuario') { ?>
                                            <p><a class="btn purple lighten-1" href="../paginas/ventanaRecepcionMuestras.php" >Mis Datos</a></p>
                                            <br>
                                            <p><a class="btn purple lighten-1" href="../paginas/ventanaBusquedaMuestras.php" >Mis Análisis</a></p>
                                        <?php } else { ?>
                                            
                                            <p><a class="btn purple lighten-1" href="../paginas/ventanaRecepcionMuestras.php" >Mis Datos</a></p>
                                            <br>
                                            <?php if($_SESSION['usuario']->getCategoria() == 'R') {?>
                                            <p><a class="btn purple lighten-1" href="../paginas/ventanaBusquedaMuestras.php" >Muestras Recibidas</a></p>
                                            <br>
                                            <p><a class="btn purple lighten-1" href="../paginas/ventanaBuscarCliente.php" >Ingresar Muestras</a></p>
                                            <br>
                                            <?php }
                                            if ($_SESSION['usuario']->getCategoria() == 'T') { ?>
                                            <p><a class="btn purple lighten-1" href="../paginas/ventanaListadoMuestras.php" >Muestras en Proceso</a></p>
                                            <?php } 
                                            if ($_SESSION['usuario']->getCategoria() == 'A') { ?>
                                            
                                            <?php }?>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
