<!DOCTYPE html>
<!-- ESTO ES UNA PLANTILLA   -->
<html lang="es">
    <head>
        <title><?php echo $titulo; ?></title>   
        <meta name="description" content="EntradaDeDatos">
        <meta name="author" content="<?php echo $author; ?>">
        <link href="../css/cssComentarios.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php include('vista/'.$registro); ?>
    </body>
</html>

