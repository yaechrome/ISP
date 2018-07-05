<?php

include_once 'BaseDao.php';

interface TipoAnalisisDao {
    
    public function listar();
    
    public function buscarPorClavePrimaria($id);
    
}
