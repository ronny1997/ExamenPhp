<div>

</div>
<?php
if (isset($_SESSION['nombre'])) {
    ?> 
 
        <?php
        foreach ($_SESSION['comentarios'] as $key => $value) {
            foreach ($value as $dentro => $values) {
                echo $values . '<br>';
            }
        }
        ?> 
  
    <h1>Cometario</h1>
    <form id="usrform" action="controlador.php<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <textarea rows="4" cols="50" name="comment" form="usrform"></textarea>
        <input type="submit" value="eniar" name="comentarios">
        <input type="submit" value="salir" name="salir">
    </form>
    <?php
} else {
    ?> 
    Acceso Denegado
    <?php
}
