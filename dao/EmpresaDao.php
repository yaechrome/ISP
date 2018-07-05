<?php

include_once 'BaseDao.php';

interface EmpresaDao extends BaseDao{
    
    public function darDeBaja($codigoEmpresa);
    
    public function buscarPorRutEmpresa($rut);
    
}
