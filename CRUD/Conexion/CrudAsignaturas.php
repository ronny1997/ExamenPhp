<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class conexion {

    private $Idb;
    private $filas = array();

    public function __construct() { // un constructor privado evita crear nuevos objetos desde fuera de la clase
        $this->Idb = new PDO("mysql:host=localhost; dbname=clasedaw18", 'root', 'A271302!!');
    }

    private function set_names() { //método para evitar problemas de ñ y acentos con la base de datos
        return $this->Idb->query("SET NAMES 'utf8'");
    }

    public function cerrar_conexion() { // Evita que el objeto se pueda clonar
        $this->Idb = null;
    }

//consulta
    public function obtener_resultados() {
        self::set_names();
        $this->filas[] = array();
        $consulta = $this->Idb->prepare('SELECT * FROM asignaturas');
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->execute();
        if ($consulta->rowCount() > 0) {
            while ($row = $consulta->fetch()) {
                $this->filas[] = $row;
            }
        }
        echo "<table>";

        foreach ($this->filas as $k => $fila) {
            if ($k == 1) {
                echo "<tr>";
                foreach ($fila as $dentro => $valor) {
                    echo "<th>" . $dentro . "</th>";
                }
                echo "<th> </th>";
                echo"</tr>";
            }
            if ($k >= 1) {
                echo "<tr>";
                foreach ($fila as $dentro => $valor) {
                    if ($dentro == 'ID') {
                        $id = $valor;
                    }
                    if ($dentro == 'NOMBRE') {
                        $nombre = $valor;
                    }
                    if ($dentro == 'CURSO') {
                        $curso = $valor;
                    }
                    if ($dentro == 'CICLO') {
                        $ciclo = $valor;
                    }
                    echo "<td>" . $valor . "</td>";
                }
                echo '<td> <a href="MasAsignaturas.php?id=' . $id . '&nombre=' . $nombre . '&curso=' . $curso . '&ciclo=' . $ciclo . '">seleccionar</a></td>';
                echo"</tr>";
            }
        }
        echo "</table>";
    }

    //Alta 
    function alta($nombre, $curso, $ciclo) {
        //$nombre, $fecha_nacimiento, $mayor_edad
         $filas[] = array();
        $consulta = $this->Idb->prepare('SELECT * FROM asignaturas');
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->execute();
        if ($consulta->rowCount() > 0) {
            while ($row = $consulta->fetch()) {
                $filas[] = $row;
            }
        }
        
        foreach ($filas as $k => $fila) {

            foreach ($fila as $dentro => $valor) {

                IF ($dentro == 'ID') {
                    $contador = $valor;
                }
            }
        }
        $contador++;
        //queri
        $orden = 'INSERT INTO `asignaturas` (ID, NOMBRE, CURSO, CICLO) VALUES (' . $contador . ', "' . $nombre . '","' . $curso . '", "' . $ciclo . '")';
        try {
            $this->Idb->exec($orden);
            echo "OK";
        } catch (PDOException $e) {
            echo $orden . "<br>" . $e->getMessage();
        }
    }

//Baja

    function baja($id) {
        //queri
        $filas[] = array();
        $consulta = $this->Idb->prepare('SELECT * FROM notas where ID_ASIGNATURA=' . $id);
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->execute();
        if ($consulta->rowCount() > 0) {
            while ($row = $consulta->fetch()) {
                $filas[] = $row;
            }
        }
        foreach ($filas as $k => $fila) {

            foreach ($fila as $dentro => $valor) {

                IF ($dentro == 'ID_ALUMNO') {
                    $orden = 'DELETE FROM `notas` WHERE `notas`.`ID_ALUMNO` = ' . $valor . ' AND `notas`.`ID_ASIGNATURA` =' . $id;
                    $this->Idb->exec($orden);
                    echo "Notas eliminadas...OK <br>";
                }
            }
        }
        //
        $orden = 'DELETE FROM asignaturas WHERE asignaturas.ID =' . $id;
        //
        try {
            $this->Idb->exec($orden);
            echo "Asiganatura eliminada OK";
        } catch (PDOException $e) {
            echo $orden . "<br>" . $e->getMessage();
        }
    }

//Modificacion

    function modificacion($nombre, $curso, $ciclo, $id) {
        //queri
        $orden = 'UPDATE asignaturas SET NOMBRE = "' . $nombre . '",CURSO="' . $curso . '",CICLO= "' . $ciclo . '" WHERE ID = ' . $id;
        try {
            $this->Idb->exec($orden);
            echo "OK";
        } catch (PDOException $e) {
            echo $orden . "<br>" . $e->getMessage();
        }
    }

}
