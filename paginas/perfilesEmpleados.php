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

function selectPerfilesEmpleados() {
    global $perfilesEmpleados;
    var_dump($perfilesEmpleados);
    
    foreach( $perfilesEmpleados as $key => $value ){
        echo '<option value="'.$key.'">'.$value.'</option>';
    }
}
