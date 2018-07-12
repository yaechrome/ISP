<?php

class AnalisisXTecnico {
    private $id;
    private $estado;
    private $tecnico;
    
    function __construct() {
        
    }

    function getId() {
        return $this->id;
    }

    function getEstado() {
        return $this->estado;
    }

    function getTecnico() {
        return $this->tecnico;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setTecnico($tecnico) {
        $this->tecnico = $tecnico;
    }


}
