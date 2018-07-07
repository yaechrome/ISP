<?php

include_once 'BaseDao.php';

interface UsuarioDao extends BaseDao{
    
    public function darDeBaja($codigoUsuario);
    
    public function buscarPorRutCliente($rut);
    
}
