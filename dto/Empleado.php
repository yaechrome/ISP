<?php


class Empleado {
    private $rut;
    private $nombre;
    private $password;
    private $categoria;
    private $estado;
            
    function __construct() {
        
    }
    
    function getEstado() {
        return $this->estado;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

        
    function getRut() {
        return $this->rut;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getPassword() {
        return $this->password;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function setRut($rut) {
        $this->rut = $rut;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }


}
