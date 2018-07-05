<?php

include_once 'BaseDao.php';

interface TelefonoDao extends BaseDao{
    
    public function listarPorCodigoParticular($codigoParticular);
}
