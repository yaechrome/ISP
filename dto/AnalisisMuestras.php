<?php


class AnalisisMuestras {
    private $id;
    private $fechaRecepcion;
    private $temperaturaRecepcion;
    private $cantidadMuestra;
    private $usuario;
    private $empleado;
    private $estado;
    
    function __construct() {
        
    }
    function getId() {
        return $this->id;
    }

    function getFechaRecepcion() {
        return $this->fechaRecepcion;
    }

    function getTemperaturaRecepcion() {
        return $this->temperaturaRecepcion;
    }

    function getCantidadMuestra() {
        return $this->cantidadMuestra;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getEmpleado() {
        return $this->empleado;
    }

    function getEstado() {
        return $this->estado;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFechaRecepcion($fechaRecepcion) {
        $this->fechaRecepcion = $fechaRecepcion;
    }

    function setTemperaturaRecepcion($temperaturaRecepcion) {
        $this->temperaturaRecepcion = $temperaturaRecepcion;
    }

    function setCantidadMuestra($cantidadMuestra) {
        $this->cantidadMuestra = $cantidadMuestra;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setEmpleado($empleado) {
        $this->empleado = $empleado;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }


    


}
