<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Mantenimiento Alumno</title>
        <link href="../Css/css.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container">
            <h1>Mantenimiento Alumnos</h1>
            <?php
        include '../Conexion/CrudAlumnos.php';
        consulta();
        ?>
        <form action = "<?php $_SERVER['PHP_SELF'] ?>" method = "POST">
            <div>
                <label for = "Nombre"> Nombre</label>
                <input type = "text" <?php
                if (isset($_GET['nombre'])) {
                    echo 'value ="' . $_GET['nombre'] . '"';
                }
                ?> name = "nombre" id = "nombre" size = "10" required = "required">
            </div>
            <div>
                <label for = "Fecha"> Fecha de nacimiento</label>
                <input type = "date" <?php
                if (isset($_GET['fech'])) {
                    echo 'value ="' . $_GET['fech'] . '"';
                }
                ?> name = "fecha" id = "fecha" size = "40" required = "required">
            </div>
            <div>
                <label for = "Mayor"> Mayor de edad</label><br>
                <input type="radio" name="gender" value="1" <?php
                if (isset($_GET['mayor'])) {
                    if ($_GET['mayor'] == 1) {
                        echo 'checked';
                    }
                }
                ?> > SI<br>
                <input type="radio" name="gender" value="0" <?php
                       if (isset($_GET['mayor'])) {
                           if ($_GET['mayor'] == 0) {
                               echo 'checked';
                           }
                       }
                ?> > NO<br>
            </div>
            <input type = "submit" value = "registrar" name = "registrar">
            <input type = "submit" value = "eliminar" name = "eliminar">
            <input type = "submit" value = "actualizar" name = "actualizar">
            <input type = "submit" value = "limpiar" name = "limpiar">
        </form>
        <?php
        if (isset($_POST['registrar'])) {
            registrar();
        }
        if (isset($_POST['eliminar'])) {
              if(isset($_GET['id'])){
                 eliminar();
            }else{
                echo 'Error: Seleccione un Alumno';
            }
           
        }
        if (isset($_POST['actualizar'])) {
            if(isset($_GET['id'])){
                actualizar();
            }else{
                echo 'Error: Seleccione un Alumno';
            }
        }
        if (isset($_POST['limpiar'])) {
         header('Location: ManAlumno.php'); 
        }

//alta();
        function registrar() {
            $name = test_imput($_POST['nombre']);
            $fech = test_imput($_POST['fecha']);
            $mayor = test_imput($_POST['gender']);
           alta($name,$fech,$mayor);
        }

        function eliminar() {
            $id = test_imput($_GET['id']);
            baja($id);
        }

        function actualizar() {
            $id = test_imput($_GET['id']);
            $name = test_imput($_POST['nombre']);
            $fech = test_imput($_POST['fecha']);
            $mayor = test_imput($_POST['gender']);
            modificacion($name, $fech, $mayor, $id);
        }
         function test_imput($data) {
                $data = trim($data);
                $data = stripcslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        ?>
        </div>
        
    </body>
</html>
