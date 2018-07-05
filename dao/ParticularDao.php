<?php

include_once 'BaseDao.php';

interface ParticularDao extends BaseDao{
    
    public function darDeBaja($codigoParticular);
    
    public function buscarPorRutParticular($rut);
    
}
