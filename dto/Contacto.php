<?php

class Contacto {
    private $rut;
    private $nombre;
    private $email;
    private $telefono;
    private $empresa;
    
    function __construct() {
        
    }
    
    function getRut() {
        return $this->rut;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getEmail() {
        return $this->email;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getEmpresa() {
        return $this->empresa;
    }

    function setRut($rut) {
        $this->rut = $rut;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }



}
