<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<a href="index.html">Inicio</a>
	<a href="subir.php">Grabar imagen</a>
	<a href="ver.php">Ver imágenes</a>
	<hr>
	<h1>Imágenes</h1>
	
	<?php
		include("conexion.php");
		$sql = "SELECT nom_ima FROM imagenes";
		$resultado = $con->query($sql);
		foreach($resultado as $fila)
		{
			$nombre = $fila["nom_ima"];
			echo "<p><img src='./archivos/$nombre'></p>";
		}
	?>
	<p>Imagen1</p>
	<p>Imagen2</p>
	<p>Imagen3</p>
	<p>Imagen4</p>

</body>
</html>