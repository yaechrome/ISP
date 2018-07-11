<?php

$perfilesEmpleados = array(
    "A" => "Administrador",
    "R" => "Receptor",
    "T" => "Técnico de laboratorio"
);

function nombreCompletoCategoria($categoria) {
    global $perfilesEmpleados;
    
    return $perfilesEmpleados[$categoria];
}

function selectPerfilesEmpleados($categoria) {
    global $perfilesEmpleados;
    
    foreach( $perfilesEmpleados as $key => $value ){
        $selected = $key == $categoria ? 'selected' : '';
        echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
    }
}
