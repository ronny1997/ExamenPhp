<?php

        class patronSingleton {

            private $Idb;
            private $filas = array();
            private static $instancia; // contenedor de la instancia

            private function __construct() { // un constructor privado evita crear nuevos objetos desde fuera de la clase
                $this->Idb = new PDO("mysql:host=localhost; dbname=radio", 'root', 'A271302!!');
            }

            private function set_names() { //método para evitar problemas de ñ y acentos con la base de datos
                return $this->Idb->query("SET NAMES 'utf8'");
            }

            public static function singleton() { //método singleton que crea instancia sí no está creada
                if (!isset(self::$instancia)) {
                    $miclase = __CLASS__;
                    self::$instancia = new $miclase;
                }
                return self::$instancia;
            }

            public function __clone() { // Evita que el objeto se pueda clonar
                trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
            }

            public function presentadores() { //método con el que obtenemos datos de la tabla usuarios
                self::set_names();
                $this->filas = array();
                $consulta = $this->Idb->prepare("SELECT * FROM presentadores");
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $consulta->execute();
                if ($consulta->rowCount() > 0) {
                    while ($row = $consulta->fetch()) {
                        $this->filas[] = $row;
                    }

                    return $this->filas;
                }
            }

            public function invitados() { //método con el que obtenemos datos de la tabla usuarios
                self::set_names();
                $this->filas = array();
                $consulta = $this->Idb->prepare("SELECT * FROM invitados");
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $consulta->execute();
                if ($consulta->rowCount() > 0) {
                    while ($row = $consulta->fetch()) {
                        $this->filas[] = $row;
                    }

                    return $this->filas;
                }
            }

            public function mostrar($resultado) { // Ejecuta consulta y devuelve array de resultados o FALSE sÃ­ falla ejecuciÃ³n
                self::set_names();
                echo "<table>";
                echo "<tr>";
                foreach ($resultado[0] as $dentro => $valor) { //coje directamente la posicion 1
                    echo "<th>" . $dentro . "</th>";
                }
                echo"</tr>";
                foreach ($resultado as $k => $fila) {
                    echo "<tr>";
                    foreach ($fila as $dentro => $valor) {
                        echo "<td>" . $valor . "</td>";
                    }
                    echo"</tr>";
                }
                echo "</table>";
            }

        }
?>