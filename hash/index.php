<?php
session_start();
// Incluir la lógica del modelo
require_once('bdd/modelo.php');
// Obtener la lista de artículos
$usuario = new Usuarios();
$come = new Comentarios();
// Incluir la lógica de la vista
if (isset($_GET['registro'])) {
    require('vista/vista2.php');
} elseif (isset($_GET['entrar'])) {
    require('vista/vista3.php');
} elseif (isset($_GET['comentarios'])) {
   $array = $GLOBALS['come']->getComentarios();
    $_SESSION['comentarios'] = $array;
    require('vista/vista4.php');
} else {
    require('vista/vista1.php');
}

