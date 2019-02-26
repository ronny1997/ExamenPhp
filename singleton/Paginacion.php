<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Ejemplo PHP</title>
		<link href="ccsE2.css" rel="stylesheet" type="text/css"/>
		<meta charset="utf-8">
		<meta name="author" content="Ronny">
		
	</head>
	<body>
<h1>Usuarios</h1>
<?php
session_start();
 $sigiente = @$_REQUEST['sig'];
 $numVis=0;

if( $sigiente==1){
	
	$numVis=$_SESSION["vis"]+3;
}
$_SESSION["vis"]=$numVis;
	//-------------------------------------------------------------------------------------------
// conectar
$link = mysqli_connect("localhost","root","1234")
		or die ("No se a podido acceder al servdor");
mysqli_select_db($link,"dwes")
		or die ("No se pudo selecionar una base de datos");
// realizar la consulta
$consulta = mysqli_query($link, "select login from usuarios limit $numVis,3");
$filas = mysqli_query($link, "select login from usuarios");

// procesar los datos
$numfilas = mysqli_num_rows($filas);
echo "numero de filas: $numfilas";
//if($numfilas==0){
//	a
//}
for($i=0;$i<$numfilas;$i++){
	$fila = mysqli_fetch_array($consulta);
	echo '<br>';
	echo $fila[0];
	echo '<br>';
}
// echo '</pre>';
// cerrar la conexion
mysqli_close($link);
	//--------------------------------------------------------------------------------------------
	?>
<a href="siguiente.php">Sigiente</a>

</body>
</html>