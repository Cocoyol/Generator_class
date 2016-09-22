<?php

if(empty(session_id()) && !isset($_SESSION)) {
    session_start();
    print_r(session_id());
}


// ------- Validaciones De Campos -------
unset($_SESSION['errClase']);
if(!isset($_POST['clase'])) {
    $_SESSION['errClase'][] = "Nombre de clase no existente. ";
} else {
    if(!notEmptyArray($_POST['clase'])) {
        $_SESSION['errClase'][] = "Nombre de clase no proporcionado. ";
    }
}
if(!isset($_POST['nombreCampo'])) {
    $_SESSION['errClase'][] = "Nombres de campos no existentes. ";
} else {
    if(!notEmptyArray($_POST['nombreCampo'])) {
        $_SESSION['errClase'][] = "No se proporcionaron nombres de campo. ";
    }
}
if(!isset($_POST['tipoCampo'])) {
    $_SESSION['errClase'][] = "Nombres de tipos de campo no existentes. ";
} else {
    if(!notEmptyArray($_POST['tipoCampo'])) {
        $_SESSION['errClase'][] = "No se proporcionaron tipos de campo. ";
    }
}

if(isset($_SESSION['errClase'])) {
    echo "<h1>No es posible ejecutar esta acción.</h1>";
    header('Location: editarClase.php');
}


// ------- Operaciones de Guardado -------
$idxClase = 1;
if(isset($_SESSION['clases'])) {
    $idxClase = max(array_keys($_SESSION['clases'])) + 1;
}
$iClase = (isset($_POST['id']))?$_POST['id']:0;
if($iClase == 0) {
    $iClase = $idxClase;
}

unset($_SESSION['clases'][$iClase]);
$_SESSION['clases'][$iClase]['nombre'] = $_POST['clase'];
foreach ($_POST['nombreCampo'] as $i => $e) {
    $_SESSION['clases'][$iClase]['campos'][$i]['nombreCampo'] = $e;
}

foreach ($_POST['tipoCampo'] as $i => $e) {
    $_SESSION['clases'][$iClase]['campos'][$i]['tipoCampo'] = $e;
}

header('Location: index.php');
//print_r($_SESSION);
//print_r($_POST);

// ------- FUNCIONES (Utilidades) -------
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