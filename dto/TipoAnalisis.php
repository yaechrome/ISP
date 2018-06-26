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

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }


}
