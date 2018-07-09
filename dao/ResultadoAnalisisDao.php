<?php

include_once 'BaseDao.php';

interface ResultadoAnalisisDao extends BaseDao{
    
    public function listarPorIdAnalisisMuestra($id);
    
    public function reporteAnalisisXTecnico();
}
