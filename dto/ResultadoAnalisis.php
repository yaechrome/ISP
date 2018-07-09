<?php


class ResultadoAnalisis {
    private $tipoAnalisis;
    private $analisisMuestra;
    private $fechaRegistro;
    private $ppm;
    private $empleado;
    
    function __construct() {
        
    }
    function getTipoAnalisis() {
        return $this->tipoAnalisis;
    }

    function getAnalisisMuestra() {
        return $this->analisisMuestra;
    }

    function getFechaRegistro() {
        return $this->fechaRegistro;
    }

    function getPpm() {
        return $this->ppm;
    }


    function getEmpleado() {
        return $this->empleado;
    }

    function setTipoAnalisis($tipoAnalisis) {
        $this->tipoAnalisis = $tipoAnalisis;
    }

    function setAnalisisMuestra($analisisMuestra) {
        $this->analisisMuestra = $analisisMuestra;
    }

    function setFechaRegistro($fechaRegistro) {
        $this->fechaRegistro = $fechaRegistro;
    }

    function setPpm($ppm) {
        $this->ppm = $ppm;
    }

    function setEmpleado($empleado) {
        $this->empleado = $empleado;
    }


}
