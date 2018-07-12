<?php


class TipoAnalisis {
    private $id;
    private $nombre;
    
    function __construct() {
        
    }

    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setId($_id) {
        $this->id = $_id;
    }

    function setNombre($_nombre) {
        $this->nombre = $_nombre;
    }




}
