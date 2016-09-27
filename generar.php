<?php
include_once "utilidades.php";

if(empty(session_id()) && !isset($_SESSION)) {
    session_start();
}

// <------- Validaciones o Comprobaciones -------
limpiarErroresSesiones();
if(!isset($_POST['proyecto'])) {
    $_SESSION['errProyecto'][] = "Nombre del proyecto inexistente. ";
} else {
    if(empty($_POST['proyecto'])) {
        $_SESSION['errProyecto'][] = "Nombre del proyecto no proporcionado. ";
    }
}
if(!isset($_SESSION['clases'])) {
    $_SESSION['errProyecto'][] = "No se ha introducido ninguna clase. ";
} else {
    if(!notEmptyArray($_SESSION['clases'])) {
        $_SESSION['errProyecto'][] = "El proyecto está vacío. ";
    }
}

if(isset($_SESSION['errProyecto'])) {

} else {


    // <------- Operaciones de Borrado -------
    $_SESSION['proyecto'] = $_POST['proyecto'];
    
    $proy = json_encode(array($_SESSION['proyecto'],$_SESSION['clases']));
    $file = "saves/".$_POST['proyecto'];
    file_put_contents($file,$proy);

}

header('Location: index.php');
//print_r($_SESSION);
//print_r($_POST);