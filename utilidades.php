<?php

// <------- Utilidades Generales -------
function notEmptyArray($V) {
    if(!empty($V)) {
        if(is_array($V)) {
            foreach($V as $e) {
                if(notEmptyArray($e)) {
                    return true;
                }
            }
            return false;
        } else {
            return true;
        }
    } else {
        return false;
    }
}


// <------- Utilidades Sesiones -------
function limpiarErroresSesiones() {
    unset($_SESSION['errProyecto']);
    unset($_SESSION['errClase']);
}