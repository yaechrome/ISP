<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author nippo
 */
class Usuario {
    private $codigo;
    private $rut;
    private $password;
    private $nombre;
    private $direccion;
    private $email;
    private $perfil;
    private $estado;
    private $telefonos;
    
    function __construct() {
        
    }
    
    function getTelefonos() {
        return $this->telefonos;
    }

    function setTelefonos($telefonos) {
        $this->telefonos = $telefonos;
    }

        
    function getPerfil() {
        return $this->perfil;
    }

    function setPerfil($perfil) {
        $this->perfil = $perfil;
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

    function getEstado() {
        return $this->estado;
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

    function setEstado($estado) {
        $this->estado = $estado;
    }


}
