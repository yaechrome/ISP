<?php

include_once 'BaseDao.php';

interface AnalisisMuestraDao extends BaseDao{
    
    public function buscarPorCodigoCliente($codigo);
    
    public function buscarPorRutReceptor($rut);
    
}
