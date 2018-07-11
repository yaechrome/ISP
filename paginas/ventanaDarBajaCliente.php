<?php
include_once('./perfilesClientes.php');
include_once('../dao/UsuarioDaoImp.php');
include_once('../dto/Usuario.php');

function htmlAlert($msg)
{
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

if ($_POST['accion'] == 'Dar de baja') {
    $dao = new UsuarioDaoImp();
    $codigo = $_POST['codigo'];
    $sePudoDarDeBaja = $dao->darDeBaja($codigo);
    
    $mensaje = $sePudoDarDeBaja
        ? "Se dio de baja el cliente número $codigo."
        : "Hubo un problema al intentar dar de baja al usuario número $codigo.";
    
    htmlAlert($mensaje);
}

function personas()
{
    $dao = new UsuarioDaoImp();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $filtro = $_POST['filtro'];
        $metodo_busqueda = $_POST['Buscar'];
    
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
