<?php

include_once 'BaseDao.php';

interface AnalisisMuestraDao extends BaseDao{
    
    public function buscarPorRutCliente($rut);
    
    public function buscarPorCodigoCliente($codigo);
    
}
