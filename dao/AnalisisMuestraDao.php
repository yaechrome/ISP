<?php

include_once 'BaseDao.php';

interface AnalisisMuestraDao extends BaseDao{
    
    public function buscarPorRutCliente($rut);
    
    public function buscarPorCodigoClienteParticular($codigo);
    
    public function buscarPorCodigoClienteEmpresa($codigo);
    
    public function buscarPorRutReceptor($rut);
    
}
