<?php

interface BaseDao {
    
    public function crear($dto);
    
    public function modificar($dto);
    
    public function listar();

    public function buscarPorClavePrimaria($id);
    
}
