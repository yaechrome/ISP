<?php


class ResultadoAnalisis {
    private $tipoAnalisis;
    private $AnalisisMuestra;
    private $fechaRegistro;
    private $ppm;
    private $estado;
    private $Empleado;
    
    function __construct() {
        
    }
    function getTipoAnalisis() {
        return $this->tipoAnalisis;
    }

    function getAnalisisMuestra() {
        return $this->AnalisisMuestra;
    }

    function getFechaRegistro() {
        return $this->fechaRegistro;
    }

    function getPpm() {
        return $this->ppm;
    }

    function getEstado() {
        return $this->estado;
    }

    function getEmpleado() {
        return $this->Empleado;
    }

    function setTipoAnalisis($tipoAnalisis) {
        $this->tipoAnalisis = $tipoAnalisis;
    }

    function setAnalisisMuestra($AnalisisMuestra) {
        $this->AnalisisMuestra = $AnalisisMuestra;
    }

    function setFechaRegistro($fechaRegistro) {
        $this->fechaRegistro = $fechaRegistro;
    }

    function setPpm($ppm) {
        $this->ppm = $ppm;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setEmpleado($Empleado) {
        $this->Empleado = $Empleado;
    }


}
