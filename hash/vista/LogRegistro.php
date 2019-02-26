<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div>
     <h1>Lista de precentadores</h1>
     <form action="controlador.php" method="POST">
        <div>
            <label for="Nombre"> Nombre</label>
            <input type="text" name="nombre" id="nombre" size="10" required="required">
        </div>
        <div>
            <label for="Contrasena"> Contraseña</label>
            <input type="password" name="clave" id="clave" size="40" required="required">
        </div>
        <?php if(isset($_GET['registro'])){ ?>
        <div>
            <label for="Dirección"> Dirección</label>
            <input type="text" name="dirección" id="dirección" size="10" required="required">
        </div>
        <div>
            <label for="Postal"> Código postal</label>
            <input type="text" name="postal" id="postal" size="10" required="required">
        </div>
         <div>
            <label for="Telefono"> Telefono</label>
            <input type="text" name="telefono" id="telefono" size="10" required="required">
        </div>
         <div>
            <label for="Fecha"> Fecha de nacimiento</label>
            <input type="date" name="fecha" id="fecha" size="10" required="required">
        </div>
         <div>
            <label for="Email"> Email</label>
            <input type="email" name="email" id="email" size="10" required="required">
        </div>
        <input type="submit" value="registrar" name="registrar">
        <?php } 
        if(!isset($_GET['registro'])){
        ?>
        <input type="submit" value="entrar" name="entrar">
         <?php 
        }
         ?>
        
        
    </form>
</div>
 