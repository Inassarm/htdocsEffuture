<?php

	if($_FILES)
	{
		//cuando gestionamos files necesitmos recoger dos cosas, el name y el tmp_name
		$nombreimg = $_FILES["lafoto"]["name"];
		$imgtemp = $_FILES["lafoto"]["tmp_name"];

		//vamos a mover la foto
		move_uploaded_file($imgtemp, "./archivos/$nombreimg");

		//vamos a grabar en la tabla el nombre de la imagen
		include("conexion.php");

		//vamos a hacer el sql para grabar
		$grabar = "INSERT INTO imagenes (nom_ima) VALUES ('$nombreimg')";

		//ejecutar
		$con->query($grabar);
		echo "Grabado";

	}


?>
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
	<h1>Subida de imágenes</h1>
	<form action="" method="POST" enctype="multipart/form-data">
		<input type="file" name="lafoto">
		<br>
		<input type="submit" value="Subir">	
	</form>
</body>
</html>