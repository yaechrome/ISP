<?php


class Telefono {
    private $id;
    private $numero;
    private $Particular;
    
    function __construct() {
        
    }
    function getId() {
        return $this->id;
    }

    function getNumero() {
        return $this->numero;
    }

    function getParticular() {
        return $this->Particular;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setParticular($Particular) {
        $this->Particular = $Particular;
    }


}
