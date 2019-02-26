<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$servername = "localhost";
$username = "root";
$password = "A271302!!";
$dbname = "clasedaw18";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Alta
function alta($idA, $idAs, $nota) {
    $sql = 'INSERT INTO notas (ID_ALUMNO, ID_ASIGNATURA, NOTA)
VALUES (' . $idA . ', ' . $idAs . ', ' . $nota . ')';

    if (mysqli_query($GLOBALS['conn'], $sql)) {
        echo "successf";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($GLOBALS['conn']);
    }
}

//Baja
function baja($idA, $idAs) {
    $sql = 'DELETE FROM `notas` WHERE `notas`.`ID_ALUMNO` = ' . $idA . ' AND `notas`.`ID_ASIGNATURA` =' . $idAs;

    if (mysqli_query($GLOBALS['conn'], $sql)) {
        echo "successf";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($GLOBALS['conn']);
    }
}

//consulta
//alumnos
function consultaAl() {
    $sql = "SELECT ID, NOMBRE FROM Alumnos";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $alu = array();
    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
           array_push($alu,$row);
        }
    } else {
        echo "0 results";
    }
    return $alu;
}
//asignatura
function consultaAs() {
    $sql = "SELECT ID, NOMBRE FROM asignaturas";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $asig = array();
    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
           array_push($asig,$row);
        }
    } else {
        echo "0 results";
    }
    return $asig;
}

//Modificacion
function modificacio($idA, $idAs, $nota) {
    $sql = 'UPDATE `notas` SET `NOTA` = ' . $nota . ' WHERE `notas`.`ID_ALUMNO` = ' . $idA . ' AND `notas`.`ID_ASIGNATURA` =' . $idAs;

    if (mysqli_query($GLOBALS['conn'], $sql)) {
        echo "successf";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($GLOBALS['conn']);
    }
}
