<?php
include_once('./perfilesClientes.php');
include_once('../dao/UsuarioDaoImp.php');
include_once('../dto/Usuario.php');
include_once '../login/sessionStart.php';

function post($key) {
    return isset($_POST[$key]) ? $_POST[$key] : "";
}

function htmlAlert($msg)
{
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

if (post('accion') == 'Dar de baja') {
    $dao = new UsuarioDaoImp();
    $codigo = post('codigo');
    $sePudoDarDeBaja = $dao->darDeBaja($codigo);
    
    $mensaje = $sePudoDarDeBaja
        ? "Se dio de baja al cliente número $codigo."
        : "Hubo un problema al intentar dar de baja al usuario número $codigo.";
    
    htmlAlert($mensaje);
}

function personas()
{
    $dao = new UsuarioDaoImp();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $filtro = post('filtro');
        $metodo_busqueda = post('Buscar');
    
        switch ($metodo_busqueda) {
            case 'RUT':
                $persona = $dao->buscarPorRutCliente($filtro);
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
        $persona->getPerfil()
    ];
    $htmlsDeLosDatos = array_map($htmlDeUnDato, $datos);
    $htmlDeTodosLosDatos = implode('', $htmlsDeLosDatos);

    $codigo = $persona->getCodigo();
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
        <meta charset="UTF-8">
        <title>Dar baja a Cliente</title>
        <style>
            .container-busquedas {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around;
            }
            .container-busquedas2 {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }
            .busqueda {
                width: 50%;
                min-width: 300px;
            }
            .grilla {
                display: grid;
                grid-template-columns: 3fr 3fr 3fr 1fr;
                grid-gap: 10px;
            }
            .header {
                border-bottom: 1px solid #000;
            }
        </style>
    </head>
    <body>
        <h1>Dar de baja a Clientes</h1>
        <div class="container-busquedas">
            <form method="POST" class="container-formulario">
                <div>Rut</div>
                <input type="text" name="filtro" value="" placeholder="12.345.678-9">
                <input type="submit" name="Buscar" value="RUT">
            </form>
            <form method="POST" class="container-formulario">
                <div>Perfil</div>
                <select name="filtro">
                    <?php selectPerfilesClientes('Particular'); ?>
                </select>
                <input type="submit" name="Buscar" value="Perfil">
            </form>
        </div>
        <div class="container-busquedas2">
            <form method="POST">
                <input type="submit" value="Listar Todos" name="btnListarTodos" />
            </form>
        </div>
        <div class="grilla">
            <div class="header">Rut</div>
            <div class="header">Nombre</div>
            <div class="header">Perfil</div>
            <div class="header"></div>
            <?= $htmlDeTodasLasPersonas ?>
        </div>
        <a href=../login/volver.php>Volver</a> <br>
    </body>
</html>
