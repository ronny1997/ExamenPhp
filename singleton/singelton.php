<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Consulta singlenton">
        <meta name="author" content="Ronny Patricio">
        <title>Consulta singlenton</title>
        <style>
            td {
                border: solid black;
            }
            table {
                border: solid black;
            }
            tr {
                border: solid black;
            }

        </style>
    </head>
    <body>
        <?php
        require_once 'consultas.php';
        $conBD2 = patronSingleton::singleton();
        $invitados = $conBD2->invitados();
        $conBD2->mostrar($invitados);
        $presentadores = $conBD2->presentadores();
        $conBD2->mostrar($presentadores);
        ?>
    </body>
</html>
