<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>ExprecionesRegulares</title>
    </head>
    <body>
        <?php
        $correos = array('ronny.montano1997@gmail.com', 'luis@ab.com', 'luis.garcia@ab.jz.es', 'luis.@ab.com', 'x@ab.jz..es');
        for ($i = 0; $i < count($correos); $i++) {
            $ok = test_email($correos[$i]);
            if ($ok) {
                print 'OK <br>';
            } else {
                print 'Error <br>';
            }
        }
        echo 'Telefonos------------------ <br>';
        $tel = array('911424272', '9122222222233333333333322', '233423423');
        for ($i = 0; $i < count($tel); $i++) {
            $ok = test_tlf($tel[$i]);
            if ($ok) {
                print 'OK tlf<br>';
            } else {
                print 'Error tlf <br>';
            }
        }
        echo 'IP------------------ <br>';
        $ip = array('192.168.1.1', '912223333223322', '233423423');
        for ($i = 0; $i < count($ip); $i++) {
            $ok = test_ip($ip[$i]);
            if ($ok) {
                print 'OK IP<br>';
            } else {
                print 'Error IP <br>';
            }
        }
        echo 'Code------------------ <br>';
        $codigo = array('SSS-2222', 'sss-333', 'DDD333');
        for ($i = 0; $i < count($codigo); $i++) {
            $ok = test_codigo($codigo[$i]);
            if ($ok) {
                print 'OK code<br>';
            } else {
                print 'Error code <br>';
            }
        }
        echo 'Password------------------ <br>';
        $pass = array('WsssssS2222wS', 'AAAAAA@AAAAAAAsss333', '6565jhvjhAAAAAAjhh');
        for ($i = 0; $i < count($pass); $i++) {
            $ok = test_password($pass[$i]);
            if ($ok) {
                print $pass[$i].'-----OK pass<br>';
            } else {
                print $pass[$i].'-----Error pass <br>';
            }
        }

        function test_email($email) {
            $patron = "/^[a-zA-Z0-9]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,3}$/";
            if (preg_match($patron, $email)) {
                $esta = true;
            } else {
                $esta = false;
            }
            return $esta;
        }

        //------------------------------------------------------------------
        function test_tlf($email) {
            $patron = "/^91[0-9]{7}$/";
            if (preg_match($patron, $email)) {
                $esta = true;
            } else {
                $esta = false;
            }
            return $esta;
        }

        function test_ip($email) {
            $patron = "/[0-9]{3}[.][0-9]{3}[.][0-9]{1,3}[.][0-9]{1,3}/";
            if (preg_match($patron, $email)) {
                $esta = true;
            } else {
                $esta = false;
            }
            return $esta;
        }

        function test_codigo($email) {
            $patron = "/^[A-Z]{3,3}[-][0-9]{3,5}$/";
            if (preg_match($patron, $email)) {
                $esta = true;
            } else {
                $esta = false;
            }
            return $esta;
        }

        function test_password($email) {
            $patron = "/[0-9]{1,}[A-Za-z]{1,}/";
            if (preg_match($patron, $email)) {
                $esta = true;
            } else {
                $esta = false;
            }
            return $esta;
        }
        ?>
    </body>
</html>
