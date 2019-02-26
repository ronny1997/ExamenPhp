<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
header('Content-Type: image/png');
session_start();
//putenv('GDFONTPATH=' . realpath('.'));
////Se genera un string y se acorta a seis caracteres 
//
$ranStr = substr(sha1(microtime()), 0, 4);
//$ranStr = 'hola';
//Se almacena el valor en una variable de sesión 
$_SESSION['captcha'] = $ranStr;
//Se crea la imagen (esta debe existir) 
$imagen = imagecreatefromjpeg("fondo_captcha.jpg");

// la funcion imagecolorallocate ( $imagen , rojo , verde , azul ) genera un color  
$color = imagecolorallocate($imagen, 0, 0, 400);
//
//imagestring($imagen, 58, 30, 8, $ranStr, $colortext);
for ($i = 0; $i < strlen($ranStr); $i++) {
//Elegir un color
    //$color = imagecolorallocate($imagen, rand(0, 255), rand(0, 255), rand(0, 255));
    $ordenada = rand(28, 29); //Elegir una ordenada
    $abscisa = ($i) * 25 + rand(14, 15); //Elegir una abscisa
    $angulo = rand(0, 75); //Elegir un ángulo
//Escribir el carácter en la imagen
    $letra = substr($ranStr, $i, 1);
    imagettftext($imagen, 24, $angulo, $abscisa, $ordenada, $color, __DIR__.'/VeraIt.TTF', $letra);
}
imagejpeg($imagen);


