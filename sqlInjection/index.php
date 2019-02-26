<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Injection</title>
    </head>
    <body><?php

        class conectaBD {

            private $conn = null;

            public function __construct() {//crea conexion
                $database = 'usuarios';
                $dsn = "mysql:host=localhost;dbname=$database;charset=UTF8"; //charset envita caracteres extraños
                try {
                    $this->conn = new PDO($dsn, 'root', 'A271302!!');
                } catch (PDOException $e) {
                    die("¡Error!: " . $e->getMessage() . "<br/>");
                }
            }

            public function __destruct() { // Cierra conexión asignándole valor null
                $this->conn = null;
            }

            public function consulta1($nombre, $clave) { // Ejecuta consulta y devuelve array de resultados o FALSE sí falla ejecución
                $orden = 'SELECT * FROM usuario WHERE login = "' . $nombre . '" and clave = "' . $clave . '"';

                //pdo cuote djd" or 1 = "1
                try {
                    $q = $this->conn->query($orden);
                    $filas = array();
                    $q->setFetchMode(PDO::FETCH_ASSOC);
                    while ($r = $q->fetch())
                        $filas[] = $r;
                    return $filas;
                } catch (PDOException $e) {
                    echo ( "¡Error! al ejecutar consulta: " . $e->getMessage() . "<br/>");
                    return false;
                }
            }

            public function quote($nombre, $clave) { // Ejecuta consulta y devuelve array de resultados o FALSE sí falla ejecución
                $name = $this->conn->quote($nombre);
                $password = $this->conn->quote($clave);
                echo $name;
                echo $password;
                $orden = 'SELECT * FROM usuario WHERE login = ' . $name . ' and clave = ' . $password . '';
                //pdo cuote djd" or 1 = "1
                try {
                    $q = $this->conn->query($orden);
                    $filas = array();
                    $q->setFetchMode(PDO::FETCH_ASSOC);
                    while ($r = $q->fetch())
                        $filas[] = $r;
                    return $filas;
                } catch (PDOException $e) {
                    echo ( "¡Error! al ejecutar consulta: " . $e->getMessage() . "<br/>");
                    return false;
                }
            }

        }
        ?>


        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <div>
                <label for="Nombre"> Nombre</label>
                <input type="text" name="nombre" id="nombre" size="10" required="required">
            </div>
            <div>
                <label for="Contrasena"> Contraseña</label>
                <input type="text" name="clave" id="clave" size="40" required="required">
            </div>
            <input type="submit" value="SinSeguridad" name="SinSeguridad">
            <input type="submit" value="ConSeguridad" name="ConSeguridad">
        </form>

        <?php
        if (isset($_POST['SinSeguridad'])) {
            $conexio = new conectaBD();
            $usuario = $_POST['nombre'];
            $clave = $_POST['clave'];
            $resul = $conexio->consulta1($usuario, $clave);
            if ($resul) {
                header("Location: entrada.php");
                print 'OK';
            }
        }
        if (isset($_POST['ConSeguridad'])) {
            $conexio = new conectaBD();
            $usuario = $_POST['nombre'];
            $clave = $_POST['clave'];
            $resul = $conexio->quote($usuario, $clave);
            if ($resul) {
                header("Location: entrada.php");
                print 'OK';
            }
        }
        ?>
    </body>
</html>
