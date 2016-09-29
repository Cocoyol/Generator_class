<?php
include_once "utilidades.php";

if(empty(session_id()) && !isset($_SESSION)) {
    session_start();
}


// <------- Validaciones o Comprobaciones -------
limpiarErroresSesiones();
if(!isset($_FILES['archivo'])) {
    $_SESSION['errProyecto'][] = "Archivo inexistente. ";
} else {
    if(!empty($_FILES['archivo']['error'])) {
        $_SESSION['errProyecto'][] = "Hubo un problema con el archivo. ";
    } else {
        $str = file_get_contents($_FILES['archivo']['tmp_name']);
        if(empty($str)) {
            $_SESSION['errProyecto'][] = "No fue posible abrir el archivo. ";
        } else {
            $json = json_decode($str,true);
            if(empty($json)) {
                $_SESSION['errProyecto'][] = "No fue posible leer el formato del archivo. ";
            }
        }
    }
}

if(isset($_SESSION['errProyecto'])) {
    echo "<h1>No es posible ejecutar esta acción.</h1>";
} else {

    // <------- Operaciones de Apertura -------
    limpiarProyecto();
    print_r($json);

    $_SESSION['proyecto'] = $json[0];
    $_SESSION['clases'] = $json[1];

}

header('Location: index.php');

//print_r($_POST);
//print_r($_FILES);
//print_r($_SESSION);