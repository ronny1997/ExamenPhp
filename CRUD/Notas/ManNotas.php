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
        <?php
        include_once '../Conexion/CrudNotas.php';
        ?>
        <div class="container">
            <h1>Notas</h1>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method = "POST">
                <label for = "alumnos"> Alumnos</label>
                <select name="alumnos">
                    <?php
                    $arrayAl = consultaAl();
                    for ($i = 0; $i < count($arrayAl); $i++) {
                        echo '<option value="' . $arrayAl[$i]['ID'] . '">' . $arrayAl[$i]['NOMBRE'] . '</option>';
                    }
                    ?> 
                </select>

                <label for = "asignaturas"> Asignaturas</label>
                <select name="asignaturas">
                    <?php
                    $arrayAs = consultaAs();
                    for ($i = 0; $i < count($arrayAs); $i++) {
                        echo '<option value="' . $arrayAs[$i]['ID'] . '">' . $arrayAs[$i]['NOMBRE'] . '</option>';
                    }
                    ?> 
                </select><br>
                <label for = "nota"> Nota</label><input type="number" name="nota"  required = "required"><br>

                <input type="submit" value="Insertar" name="inser">
                <input type="submit" value="Actualizar" name="act">
            </form>
            <?php
            if (isset($_POST['inser'])) {
                $idAlu = test_imput($_POST['alumnos']);
                $idAs = test_imput($_POST['asignaturas']);
                $nota = test_imput($_POST['nota']);
                alta($idAlu, $idAs, $nota);
            }
            if (isset($_POST['act'])) {
                $idAlu = test_imput($_POST['alumnos']);
                $idAs = test_imput($_POST['asignaturas']);
                $nota = test_imput($_POST['nota']);
                modificacio($idAlu, $idAs, $nota);
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
