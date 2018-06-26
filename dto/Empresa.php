<?php

class Empresa {
     private $codigo;
     private $rut;
     private $nombre;
     private $password;
     private $direccion;
     
     function __construct() {
         
     }

     function getCodigo() {
         return $this->codigo;
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

     function getDireccion() {
         return $this->direccion;
     }

     function setCodigo($codigo) {
         $this->codigo = $codigo;
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

     function setDireccion($direccion) {
         $this->direccion = $direccion;
     }


}
