<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//conectar
function conexion() {
    $link = mysqli_connect("localhost", "root", "A271302!!")
            or die("No se a podido acceder al servdor");
    mysqli_select_db($link, "clasedaw18")
            or die("No se pudo selecionar una base de datos");

    return $link;
}

function desconexion($link) {
    mysqli_close($link);
}


