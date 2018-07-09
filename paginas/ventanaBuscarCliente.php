<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../static/css/codebeautify.css" type="text/css"/>
    <div class="text_right">
        <a class="btn red darken-1" href=../login/logout.php>Cerrar Sesion </a>
    </div>
    <title></title>
</head>
<body>
    <main role="main">
        <section class="container">
            <div class="row mb0 center-align relative full">
                <div class="center">
                    <div class="col s12 m6 offset-m3 l4 offset-l4">
                        <div class="card">
                            <div class="card-panel pad0">
                                <div class="card-content pad24">
                                    <form action="buscarCliente.php" method="POST">
                                        <div>
                                            <div class="mb20"><h3 class="medium title">Buscar Cliente por Rut</h3></div>  
                                            <table border="1">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="input-field col s12">
                                                                <label for="txtRut">Rut</label><br>
                                                                <input class="validate" name="txtRut" type="text" id="password">
                                                                <br><br>
                                                            </div>
                                                        </td>
                                                        <td> <input type="submit" value="Buscar" name="btnBuscarPorRut" /></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <br>
                                        </div>
                                    </form>
                                    <br><br>
                                    <a href=../login/volver.php>Volver</a> <br>
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