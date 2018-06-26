<?php


class AnalisisMuestras {
    private $id;
    private $fechaRecepcion;
    private $temperaturaRecepcion;
    private $cantidadMuestra;
    private $Empresa;
    private $Particular;
    private $Empleado;
    
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

    function getEmpresa() {
        return $this->Empresa;
    }

    function getParticular() {
        return $this->Particular;
    }

    function getEmpleado() {
        return $this->Empleado;
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

    function setEmpresa($Empresa) {
        $this->Empresa = $Empresa;
    }

    function setParticular($Particular) {
        $this->Particular = $Particular;
    }

    function setEmpleado($Empleado) {
        $this->Empleado = $Empleado;
    }


}
