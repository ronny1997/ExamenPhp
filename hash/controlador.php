<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
include_once 'bdd/modelo.php';
$usuario = new Usuarios;
$come = new Comentarios();

if (isset($_POST['registrar'])) {
    $nombre = test_imput($_POST['nombre']);
    $clave = test_imput($_POST['clave']);
    $direccion = test_imput($_POST['dirección']);
    $postal = test_imput($_POST['postal']);
    $telefono = test_imput($_POST['telefono']);
    $fecha = test_imput($_POST['fecha']);
    $email = test_imput($_POST['email']);

    $ok = test_tlf($telefono);
    if ($ok) {
        $ok = test_cp($postal);
        if ($ok) {
            $ok = test_direccion($direccion);
            if ($ok) {
                $resultado = $GLOBALS['usuario']->InsertUsuarios($nombre, $clave, $direccion, $postal, $telefono, $telefono, $fecha, $email);
                print '<a href="index.php">Página Principal</a>';
            } else {
                echo 'Direccion error';
            }
        } else {
            echo 'Codigo Postal error';
        }
    } else {
        echo 'tlf error';
    }
}
if (isset($_POST['entrar'])) {

    $nombre = test_imput($_POST['nombre']);
    $_SESSION['nombre'] = $nombre;
    $clave = test_imput($_POST['clave']);
    $GLOBALS['usuario']->login($nombre, $clave);
}
if (isset($_POST['salir'])) {
    session_destroy();
    header('Location:index.php');
}
if (isset($_POST['comentarios'])) {

    $nombre = $_SESSION['nombre'];
    $comentario = test_imput($_POST['comment']);
    $hoy = getdate();
    $fecha = $hoy['year'] . '-' . $hoy['mon'] . '-' . $hoy['mday'];
    $GLOBALS['come']->InsertCOMENTARIOS($nombre, $comentario, $fecha);
}

function test_tlf($tlf) {
    $patron = "/^91[0-9]{7}$/";
    if (preg_match($patron, $tlf)) {
        $esta = true;
    } else {
        $esta = false;
    }
    return $esta;
}

function test_cp($cp) {
    $patron = "/^[0-9]{5}$/";
    if (preg_match($patron, $cp)) {
        $esta = true;
    } else {
        $esta = false;
    }
    return $esta;
}

function test_direccion($direc) {
    $patron = "/[a-z]/";
    if (preg_match($patron, $direc)) {
        $esta = true;
    } else {
        $esta = false;
    }
    return $esta;
}

function test_imput($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//session_start();
//include_once 'bdd/modelo.php';
//$usuario = new Usuarios;
//$come = new Comentarios();
//
//if (isset($_POST['registrar'])) {
//    $nombre = $_POST['nombre'];
//    $clave = ($_POST['clave']);
//    $direccion = ($_POST['dirección']);
//    $postal = ($_POST['postal']);
//    $telefono = ($_POST['telefono']);
//    $fecha = ($_POST['fecha']);
//    $email = ($_POST['email']);
//
//    $ok = test_tlf($telefono);
//
//    if ($ok) {
//        $ok = test_cp($postal);
//        if ($ok) {
//            $ok = test_direccion($direccion);
//            if ($ok) {
//                $resultado = $GLOBALS['usuario']->InsertUsuarios($nombre, $clave, $direccion, $postal, $telefono, $telefono, $fecha, $email);
//                print '<a href="index.php">Página Principal</a>';
//            } else {
//                echo 'Direccion error';
//            }
//        } else {
//            echo 'Codigo Postal error';
//        }
//    } else {
//        echo 'tlf error';
//    }
//}
//if (isset($_POST['entrar'])) {
//
//    $nombre = ($_POST['nombre']);
//    $_SESSION['nombre'] = $nombre;
//    $clave = ($_POST['clave']);
//    $GLOBALS['usuario']->login($nombre, $clave);
//}
//if (isset($_POST['salir'])) {
//    session_destroy();
//    header('Location:index.php');
//}
//if (isset($_POST['comentarios'])) {
//
//    $nombre = $_SESSION['nombre'];
//    $comentario = ($_POST['comment']);
//    $hoy = getdate();
//    $fecha = $hoy['year'] . '-' . $hoy['mon'] . '-' . $hoy['mday'];
//    $GLOBALS['come']->InsertCOMENTARIOS($nombre, $comentario, $fecha);
//}
//
//function test_tlf($tlf) {
//    $patron = "/^91[0-9]{7}$/";
//    if (preg_match($patron, $tlf)) {
//        $esta = true;
//    } else {
//        $esta = false;
//    }
//    return $esta;
//}
//
//function test_cp($cp) {
//    $patron = "/^[0-9]{5}$/";
//    if (preg_match($patron, $cp)) {
//        $esta = true;
//    } else {
//        $esta = false;
//    }
//    return $esta;
//}
//
//function test_direccion($direc) {
//    $patron = "/[a-z]/";
//    if (preg_match($patron, $direc)) {
//        $esta = true;
//    } else {
//        $esta = false;
//    }
//    return $esta;
//}
//
////function test_imput($data) {
////    $data = trim($data);
////    $data = stripcslashes($data);
////    $data = htmlspecialchars($data);
////    return $data;
////}