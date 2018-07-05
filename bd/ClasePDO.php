<?php


class ClasePDO extends PDO{
    function __construct() {
        try {
            parent::__construct('mysql:host=127.0.0.1;dbname=isp', 'root', '');
            parent::setAttribute(PDO:: ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $ex) {
            die('La base de datos seleccionada no existe');
        }
    }
}
