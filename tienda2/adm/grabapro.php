<?php

	//recibo datos del form
	$arc = $_FILES['archivo']["name"];
	$tem = $_FILES['archivo']["tmp_name"];

	$tit = $_POST['titulo'];
	$des = $_POST['descripcion'];
	$pre = $_POST['precio'];
	
	//metemos conexion. Recuerda que está en la carpeta de fuera: ../

	include("./../conexion.php");

	//sql para grabar el prodcuto

	$sql = "INSERT INTO productos (nom_pro, titulo_pro, descripcion_pro, precio_pro) VALUES ('$arc', '$tit', '$des', '$pre')";

	//ejecutamos el sql
	$con->query($sql);

	//tengo que saber la id del producto que acabo de grabar
	$idpro = $con->insert_id;

	//creamos la carpeta con ese id. OJO, la carpeta de productos está fuera: ../

	mkdir("./../productos/$idpro", 0777);

	//movemos la imagen a esa nueva ruta

	move_uploaded_file($tem, "./../productos/$idpro/$arc");

	//ya está grabado el producto y movida la imagen. Enviamos al index.

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<!-- fontawesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- fuentes -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
	<style>
		body
		{
			background-color: dimgrey;
			color: white;
			font-family: "Raleway", sans-serif;
			font-optical-sizing: auto;
			font-weight: <weight>;
			font-style: normal;
		}

		a
		{
			color: hotpink;
			text-decoration: none;
		}

		a:hover
		{
			color: white;
		}

		input
		{
			width: 60%;
		}

		button
		{
			background-color: hotpink;
			color: white;
			border-radius: 5px;
			border: none;
		}

		button:hover
		{
			background-color: white;
			color: hotpink;
		}
	</style>
</head>
<body>
	<center>
		<a href="index.html"><i class="fa-solid fa-home"></i></a>
		<!-- enlace para ver la tienda: recuerda que está en la carperta de fuera -->
		<a href="./../index.php"><i class="fa-solid fa-shop"></i></a>
		<hr>
		<h1>Producto registrado</h1>
		<p>¿Quieres grabar otro producto? <br>
			<button onclick="window.location.href='index.html'">Si</button>
		</p>
	</center>	
</body>
</html>