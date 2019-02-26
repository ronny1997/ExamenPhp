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
        //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
        // $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
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
//transacciones
 public function transaccion($insertCuenta, $saldoCuenta1, $movimiento, $setNumcuenta1) {

        try {
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //umero de cuentas
            $this->Idb->exec($setNumcuenta1);
            //Saldo cuenta 1
            $this->Idb->exec($saldoCuenta1);
            //altacuenta
            $this->Idb->exec($insertCuenta);
            //grabar movimiento
            $this->Idb->exec($movimiento);

            $this->Idb->commit();
        } catch (Exception $e) {
            $this->Idb->rollBack();
            echo "Fallo: " . $e->getMessage();
        }
    }
//Modificacion

    function modificacion($nombre, $curso, $ciclo, $id) {
        //queri
            // set the PDO error mode to exception
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $orden = 'UPDATE asignaturas SET NOMBRE = "' . $nombre . '",CURSO="' . $curso . '",CICLO= "' . $ciclo . '" WHERE ID = ' . $id;
        try {
            $this->Idb->exec($orden);
            echo "OK";
        } catch (PDOException $e) {
            echo $orden . "<br>" . $e->getMessage();
        }
    }

    function preparadas() {
        $sentencia = $this->Idb->prepare("INSERT INTO REGISTRY (name, value) VALUES (:name, :value)");
        $sentencia->bindParam(':name', $nombre);
        $sentencia->bindParam(':value', $valor);

// insertar una fila
        $nombre = 'uno';
        $valor = 1;
        $sentencia->execute();

// insertar otra fila con diferentes valores
        $nombre = 'dos';
        $valor = 2;
        $sentencia->execute();

//        $sentencia = $mbd->prepare("SELECT * FROM REGISTRY where name = ?");
//if ($sentencia->execute(array($_GET['name']))) {
//  while ($fila = $sentencia->fetch()) {
//    print_r($fila);
//  }
//}
    }

}
