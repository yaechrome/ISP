<?php


class AnalisisMuestras {
    private $id;
    private $fechaRecepcion;
    private $temperaturaRecepcion;
    private $cantidadMuestra;
    private $usuario;
    private $empleado;
    
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

    function setParticular($usuario) {
        $this->usuario = $usuario;
    }

    function setEmpleado($empleado) {
        $this->empleado = $empleado;
    }


}
