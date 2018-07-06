<?php


class Particular {
    private $codigo;
    private $rut;
    private $password;
    private $nombre;
    private $direccion;
    private $email;
    private $estado;
    
    function __construct() {
        
    }
    function getEstado() {
        return $this->estado;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

        function getCodigo() {
        return $this->codigo;
    }

    function getRut() {
        return $this->rut;
    }

    function getPassword() {
        return $this->password;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getEmail() {
        return $this->email;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setRut($rut) {
        $this->rut = $rut;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setEmail($email) {
        $this->email = $email;
    }


}
