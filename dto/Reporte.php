<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reporte
 *
 * @author nippo
 */
class Reporte {
    private $rut;
    private $nombre;
    private $cantidad;
    
    function __construct() {
        
    }
    
    function getRut() {
        return $this->rut;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function setRut($rut) {
        $this->rut = $rut;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }



}
