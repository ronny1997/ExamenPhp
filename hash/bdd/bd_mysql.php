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
        $this->Idb = new PDO("mysql:host=localhost; dbname=usuarios", 'adminCom', 'A10214!!');
    }

    private function set_names() { //método para evitar problemas de ñ y acentos con la base de datos
        return $this->Idb->query("SET NAMES 'utf8'");
    }

    public function cerrar_conexion() { // Evita que el objeto se pueda clonar
        $this->Idb = null;
    }

    public function registrar($qli) {
        $this->Idb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // use exec() because no results are returned
        try {
            $this->Idb->exec($qli);
            echo 'Alta OK';
        } catch (PDOException $e) {
            echo $qli . "<br>" . $e->getMessage();
        }
    }
    public function datos($qli){
        $filas[] = array();
        $consulta = $this->Idb->prepare($qli);
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->execute();
        if ($consulta->rowCount() > 0) {
            while ($row = $consulta->fetch()) {
                $filas[] = $row;
            }
        }
        return $filas;
        
    }

    public function quote($quote) {

        return $this->Idb->quote($quote);
    }

}
?>
