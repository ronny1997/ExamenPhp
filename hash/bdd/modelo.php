<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'bd_mysql.php';
require_once 'password/password.php';

class Usuarios {

    private $conn;

    public function __construct() { // un constructor privado evita crear nuevos objetos desde fuera de la clase
        $this->conn = new conexion();
    }

//    public function __construct() { // un constructor privado evita crear nuevos objetos desde fuera de la clase
//    }
    function InsertUsuarios($nombre, $password, $direccion, $cp, $tlf, $fch, $email) {

        $nombre = $this->conn->quote($nombre);
        $password = $this->conn->quote($password);
        $hash = Password::hash($password);

        $direccion = $this->conn->quote($direccion);
        $cp = $this->conn->quote($cp);
        $tlf = $this->conn->quote($tlf);

        $fch = $this->conn->quote($fch);
        $email = $this->conn->quote($email);



        $this->conn->registrar('INSERT INTO reguistro (`nombre`, `password`, `direccion`, `c.p`, `tlf`, `fch`, `email`) VALUES (' . $nombre . ', "' . $hash . '", ' . $direccion . ', ' . $cp . ', ' . $tlf . ', ' . $fch . ', ' . $email . ')');
        //INSERT INTO `registro` (`nombre`, `password`, `direccion`, `c.p`, `tlf`, `fch`, `email`) VALUES ('ss', 'ss', 'sss', '22', '4555', '2019-02-19', 'ddc');
        $this->conn->cerrar_conexion();
    }

    function login($nombre, $password) {
        $nombre = $this->conn->quote($nombre);
        $NomPass = $this->conn->datos('SELECT password FROM reguistro WHERE nombre =' . $nombre . '');
        $password = $this->conn->quote($password);

                if (Password::verify($password, $NomPass[1]['password'])) {
                    header('Location:index.php?comentarios=1');
                } else {
                    echo 'Usuario o Contraseña incorrectos';
                }
    }

}

class Comentarios {

    private $conn;

    public function __construct() { // un constructor privado evita crear nuevos objetos desde fuera de la clase
        $this->conn = new conexion();
    }

//    public function __construct() { // un constructor privado evita crear nuevos objetos desde fuera de la clase
//    }
    function InsertCOMENTARIOS($nombre, $comentario, $fecha) {

        $nombre = $this->conn->quote($nombre);
        $comentario = $this->conn->quote($comentario);
        $fecha = $this->conn->quote($fecha);
        //AUTO_INCREMENT

        $this->conn->registrar('INSERT INTO comentario (`nombre`, `comentario`, `fecha`) VALUES (' . $nombre . ', ' . $comentario . ', ' . $fecha . ')');
        header('Location:index.php?comentarios=1');
        //INSERT INTO `registro` (`nombre`, `password`, `direccion`, `c.p`, `tlf`, `fch`, `email`) VALUES ('ss', 'ss', 'sss', '22', '4555', '2019-02-19', 'ddc');
        $this->conn->cerrar_conexion();
    }

    function getComentarios() {
        $NomPass = $this->conn->datos('SELECT * FROM comentario des');
        return $NomPass;
    }

}
