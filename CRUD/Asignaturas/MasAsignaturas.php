<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../Css/css.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container">
            <h1>Asignaturas</h1>
            <?php
            include_once '../Conexion/CrudAsignaturas.php';
            $bd = new conexion();
            $bd->obtener_resultados();
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
                    <label for = "curso"> Curso</label>
                    <select name="curso">
                        <option value="PRIMERO" <?php
                        if (isset($_GET['curso'])) {
                            if ($_GET['curso'] == 'PRIMERO') {
                                echo 'selected';
                            }
                        }
                        ?>>Primero</option>
                        <option value="SEGUNDO" <?php
                        if (isset($_GET['curso'])) {
                            if ($_GET['curso'] == 'SEGUNDO') {
                                echo 'selected';
                            }
                        }
                        ?>>Segundo</option>
                    </select>
                </div>
                <div>
                    <label for = "cliclo"> Fecha de nacimiento</label>
                    <select name="cliclo">
                        <option value="DAW"<?php
                        if (isset($_GET['ciclo'])) {
                            if ($_GET['ciclo'] == 'DAW') {
                                echo 'selected';
                            }
                        }
                        ?>>DAW</option>
                        <option value="ASIR"<?php
                        if (isset($_GET['ciclo'])) {
                            if ($_GET['ciclo'] == 'ASIR') {
                                echo 'selected';
                            }
                        }
                        ?>>ASIR</option>
                    </select>
                </div>
                <input type = "submit" value = "registrar" name = "registrar">
                <input type = "submit" value = "eliminar" name = "eliminar">
                <input type = "submit" value = "actualizar" name = "actualizar">
                <input type = "submit" value = "limpiar" name = "limpiar">
                <?php
                if (isset($_POST['limpiar'])) {
                    header('Location: MasAsignaturas.php');
                }
                if (isset($_POST['registrar'])) {
                    alta();
                }
                if (isset($_POST['eliminar'])) {
                    if (isset($_GET['id'])) {
                        baja();
                    }
                }
                if (isset($_POST['actualizar'])) {
                    if (isset($_GET['id'])) {
                        modificacion();
                    }
                }

                function alta() {
                    $nombre = test_imput($_POST['nombre']);
                    $curso = test_imput($_POST['curso']);
                    $ciclo = test_imput($_POST['cliclo']);
                    $GLOBALS['bd']->alta($nombre, $curso, $ciclo);
                }

                function baja() {
                    $id = test_imput($_GET['id']);
                    $GLOBALS['bd']->baja($id);
                }

                function modificacion() {
                    $id = $_GET['id'];
                    $nombre = test_imput($_POST['nombre']);
                    $curso = test_imput($_POST['curso']);
                    $ciclo = test_imput($_POST['cliclo']);

                    $GLOBALS['bd']->modificacion($nombre, $curso, $ciclo, $id);
                }
                   function test_imput($data) {
                $data = trim($data);
                $data = stripcslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
                ?>
            </form>
        </div>

    </body>
</html>
