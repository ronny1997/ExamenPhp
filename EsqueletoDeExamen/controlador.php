<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//session_start();
//include_once 'bdd/modelo.php';
//$usuario = new Usuarios;
//$come = new Comentarios();
//if (isset($_POST['registrar'])) {
//    $nombre = test_imput($_POST['nombre']);
//
//}





function test_imput($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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

function test_password($email) {
    $patron = "/[0-9]{1,}[A-Za-z]{1,}/";
    if (preg_match($patron, $email)) {
        $esta = true;
    } else {
        $esta = false;
    }
    return $esta;
}

function test_email($email) {
    $patron = "/^[a-zA-Z0-9]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,3}$/";
    if (preg_match($patron, $email)) {
        $esta = true;
    } else {
        $esta = false;
    }
    return $esta;
}
//Comparasion de estring---->strcmp ($cadena1 , $cadena2 )==1;