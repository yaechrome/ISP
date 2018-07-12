<?php
include_once('./perfilesEmpleados.php');
include_once('../dao/EmpleadoDaoImp.php');
include_once('../dto/Empleado.php');
include_once '../login/sessionStart.php';

function post($key) {
    return isset($_POST[$key]) ? $_POST[$key] : "";
}

function htmlAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

if (post('accion') == 'Dar de baja') {
    $dao = new EmpleadoDaoImp();
    $codigo = post('codigo');
    $sePudoDarDeBaja = $dao->darDeBaja($codigo);

    $mensaje = $sePudoDarDeBaja ? "Se dio de baja al empleado con RUT $codigo." : "Hubo un problema al intentar dar de baja al empleado con RUT $codigo.";

    htmlAlert($mensaje);
}

function personas() {
    $dao = new EmpleadoDaoImp();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $filtro = post('filtro');
        $metodo_busqueda = post('Buscar');

        switch ($metodo_busqueda) {
            case 'RUT':
                $persona = $dao->buscarPorRut($filtro);
                return $persona ? array($persona) : array();

            case 'Perfil':
                return iterator_to_array($dao->buscarPorPerfil($filtro));
        }
    }

    return iterator_to_array($dao->listar());
}

$htmlDeUnaPersona = function ($persona) {
    $htmlDeUnDato = function ($dato) {
        return "<div>$dato</div>";
    };
    $datos = [
        $persona->getRut(),
        $persona->getNombre(),
        nombreCompletoCategoria($persona->getCategoria())
    ];
    $htmlsDeLosDatos = array_map($htmlDeUnDato, $datos);
    $htmlDeTodosLosDatos = implode('', $htmlsDeLosDatos);

    $codigo = $persona->getRut();
    $htmlDelBoton = <<<HTML
    <form method="POST">
        <input type="hidden" name="codigo" value="$codigo">
        <input type="submit" name="accion" value="Dar de baja">
    </form>
HTML;

    return $htmlDeTodosLosDatos . $htmlDelBoton;
};

$htmlsDeTodasLasPersonas = array_map($htmlDeUnaPersona, personas());
$htmlDeTodasLasPersonas = implode('', $htmlsDeTodasLasPersonas);
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../static/css/postulacion.css" type="text/css"/>
        <meta charset="UTF-8">
        <title>Dar baja a Empleado</title>
        <style>
            .grilla {
                display: grid;
                grid-template-columns: 3fr 3fr 3fr 1fr;
                grid-gap: 10px;
            }
        </style>
    </head>
    <body>
        <main role="main">
            <section class="container">
                <div class="row mb0 center-align relative full">
                    <div class="center">
                        <div class="card">
                            <div class="card-panel pad0">
                                <div class="card-content pad24">
                                    <div class="mb20"><h3 class="medium title">Dar de baja a Empleados</h3></div>  

                                    <div class="container-busquedas">
                                        <form method="POST" class="container-formulario">
                                            <div>Rut</div>
                                            <input type="text" name="filtro" value="" placeholder="12.345.678-9">
                                            <input type="submit" name="Buscar" value="RUT">
                                        </form>
                                        <br>
                                        <form method="POST" class="container-formulario">
                                            <div>Perfil</div>
                                            <select name="filtro">
                                                <?php selectPerfilesEmpleados('A'); ?>
                                            </select>
                                            <input type="submit" name="Buscar" value="Perfil">
                                        </form>
                                        <br>
                                    </div>
                                    <div class="container-busquedas2">
                                        <form method="POST">
                                            <input type="submit" value="Listar Todos" name="btnListarTodos" />
                                        </form>
                                        <br>
                                    </div>
                                    <div class="grilla text_left">
                                        <div class="header">Rut</div>
                                        <div class="header">Nombre</div>
                                        <div class="header">Perfil</div>
                                        <div class="header"></div>
                                        <?= $htmlDeTodasLasPersonas ?>
                                    </div>
                                    <br>
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
