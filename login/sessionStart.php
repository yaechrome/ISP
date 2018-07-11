<?php

include_once '../dto/Usuario.php';
include_once '../dto/Empleado.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
