<?php

include_once 'BaseDao.php';

interface ContactoDao extends BaseDao{
    
    public function listarPorCodigoEmpresa($codigoEmpresa);
    
}
