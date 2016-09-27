<?php

if(empty(session_id()) && !isset($_SESSION)) {
    session_start();
}


// <------- Validaciones o Comprobaciones -------
limpiarErroresSesiones();
if(!isset($_GET['id'])) {
    $_SESSION['errProyecto'][] = "Operación No realizada. Identificador de clase no proporcionado. ";
} else {
    if(!isset($_SESSION['clases'][$_GET['id']])) {
        $_SESSION['errProyecto'][] = "Operación No realizada. Identificador de clase inexistente. ";
    }
}

if(isset($_SESSION['errProyecto'])) {
    echo "<h1>Identificador de clase no proporcionado.</h1>";
} else {


    // <------- Operaciones de Borrado -------
    unset($_SESSION['clases'][$_GET['id']]);

}

header('Location: index.php');