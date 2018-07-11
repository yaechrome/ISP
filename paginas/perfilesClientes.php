<?php

$perfilesClientes = array(
    "Particular",
    "Empresa"
);

function selectPerfilesClientes($perfil) {
    global $perfilesClientes;
    
    foreach( $perfilesClientes as $value ){
        $selected = $key == $perfil ? 'selected' : '';
        echo '<option value="'.$value.'" '.$selected.'>'.$value.'</option>';
    }
}
