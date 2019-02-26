<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Password {
     public static function hash($password) {
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => 15]);
    }
    public static function verify($password, $hash) {
        return password_verify($password, $hash);
    }
    
}

 //Crear la contraseña:
//$hash = Password::hash('micontraseña');
//// Comprobar la contraseña introducida
//if (Password::verify('micontraseña', $hash)) {
//    echo 'Contraseña correcta!\n';
//} else {
//    echo "Contraseña incorrecta!\n";
//}