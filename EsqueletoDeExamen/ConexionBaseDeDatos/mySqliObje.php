<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function conexion() {
    $link = new mysqli("localhost", "root", "A271302!!", "clasedaw18")
            or die("No se a podido acceder al servdor");


    return $link;
}

function desconexion($link) {
    mysqli_close($link);
}

$link = conexion();

//Consulta
function consulta() {

    $result2 = $GLOBALS['link']->query("SELECT * FROM alumnos");
    //pintar alumnos
    print '<table>';
    $contador = 0;
    while ($row = $result2->fetch_assoc()) {
        $contador++;
        if ($contador == 1) {
            print '<tr>';
            foreach ($row as $key => $value) {

                print '<th>';
                echo '' . $key;
                // echo "id: " . $row["ID"] . " - Name: " . $row["NOMBRE"] . "Fecha " . $row["FECHA_NACIMIENTO"] . "<br>";
                print '</th>';
            }
            print '<th>';

            print '</th>';
            print '</tr>';
        }
        //-----------------------------------------------------------------
        print '<tr>';
        foreach ($row as $key => $value) {
            if ($key == 'MAYOR_EDAD') {
                $edad = $value;
            }
            if ($key == 'FECHA_NACIMIENTO') {
                $fechNa = $value;
            }
            if ($key == 'NOMBRE') {
                $nombre = $value;
            }
            if ($key == 'ID') {
                $id = $value;
            }
            print '<td>';
            if ($key == 'MAYOR_EDAD') {
                if ($value == 1) {

                    echo 'Si';
                } else {
                    echo 'No';
                }
            } else {
                echo '' . $value;
            }
            print '</td>';
        }
        print '<td>';
        print '<a href="ManAlumno.php?id=' . $id . '&mayor=' . $edad . '&fech=' . $fechNa . '&nombre=' . $nombre . '">Seleccionar</a>';
        print '</td>';

        print '</tr>';
    }
    print '</table>';
}

//Alta 
function alta($nombre, $fech, $mayor) {
    //$nombre, $fecha_nacimiento, $mayor_edad
    //queri
    $orden = 'INSERT INTO `alumnos` ( NOMBRE, FECHA_NACIMIENTO, MAYOR_EDAD) VALUES ("' . $nombre . '","' . $fech . '", ' . $mayor . ')';
    //insertar
//procesar los datos
    if ($GLOBALS['link']->query($orden) === TRUE) {
        echo "success";
    } else {
        echo "Error: " . $orden . "<br>" . $GLOBALS['link']->error;
    }
}

//Baja

function baja($id) {
    $result2 = $GLOBALS['link']->query('SELECT ID_ASIGNATURA FROM notas where ID_ALUMNO=' . $id);

    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $orden = 'DELETE FROM `notas` WHERE `notas`.`ID_ALUMNO` = ' . $id . ' AND `notas`.`ID_ASIGNATURA` =' . $row['ID_ASIGNATURA'];
            ;
            $GLOBALS['link']->query($orden);
            echo "Notas eliminadas...OK <br>";
        }
    }
    //queri
    $orden = 'DELETE FROM alumnos WHERE alumnos.ID =' . $id;

    if ($GLOBALS['link']->query($orden) === TRUE) {
        echo "OK";
    } else {
        echo "Error deleting record: " . $GLOBALS['link']->error;
    }
}

//Modificacion

function modificacion($nombre, $fecha_nacimiento, $mayor_edad, $id) {

    //queri
    $orden = 'UPDATE alumnos SET NOMBRE = "' . $nombre . '",FECHA_NACIMIENTO="' . $fecha_nacimiento . '",MAYOR_EDAD= ' . $mayor_edad . ' WHERE ID = ' . $id;
    //insertar

    if ($GLOBALS['link']->query($orden) === TRUE) {
        echo "OK";
    } else {
        echo "Error deleting record: " . $GLOBALS['link']->error;
    }
}
function preparadas(){
    //conectar
	$link = new mysqli("localhost", "root", "1234", "dwes");
		if ($link->connect_errno) {
			echo "Falló la conexión a MySQL: (" . $link->connect_errno . ") " . $link->connect_error;
		}else{ 
		// Establecer parámetros y ejecutar
		$hoy = getdate();
		$ID = 04;
		$NOMBRE = "Profesora";
		$FECHA_NACIMIENTO = $hoy;
		$MAYOR_EDAD = 0;
		//insertar1
		$stmt = $link->prepare("INSERT INTO alumnos (ID, NOMBRE, FECHA_NACIMIENTO, MAYOR_EDAD) VALUES (?, ?, ?, ?)");
		$stmt->bind_param('isii', $ID, $NOMBRE, $FECHA_NACIMIENTO, $MAYOR_EDAD );//isii indica string numero y esas cosas en orden
		$stmt->execute();
		//Comprueba si esta bn  siempre va despues del execute
		$sentencia = $stmt -> affected_rows;
		echo($sentencia);		
		//insertar2
		$hoy = getdate();
		$ID = 05;
		$NOMBRE = "Erick";
		$FECHA_NACIMIENTO = $hoy;
		$MAYOR_EDAD = 0;
		$stmt->bind_param('isii', $ID, $NOMBRE, $FECHA_NACIMIENTO, $MAYOR_EDAD );//isii indica string numero y esas cosas en orden
		$stmt->execute();
		//Comprueba si esta bn  siempre va despues del execute
		$sentencia = $stmt -> affected_rows;
		echo($sentencia);
		//actualizar
		$ID3 = 4;
		$newNomb = "este";
		$stmt = $link->prepare("UPDATE alumnos SET NOMBRE = ? WHERE ID = ?");
		$stmt->bind_param('si',$newNomb,$ID3);
		$stmt->execute();
		//Comprueba si esta bn  siempre va despues del execute
		$sentencia = $stmt -> affected_rows;
		echo($sentencia);
		//borrar
		$ID2 = 4;
		$stmt = $link->prepare("DELETE FROM alumnos WHERE alumnos.ID = ?");
		$stmt->bind_param('i',$ID2);
		$stmt->execute();
		//Comprueba si esta bn  siempre va despues del execute
		$sentencia = $stmt -> affected_rows;
		echo($sentencia);
		// Mensaje de éxito en la inserción
		echo "Se han creado las entradas exitosamente";
		// Cerrar conexiones
		$stmt->close();
		$link->close();
		}
}