<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<center>
	<?php
		include("menus.php");
		pinta_menunolog();
	?>
	<h1>Contacto</h1>
	<span>Escribe tus dudas</span>
	<form>
		<input type="text" placeholder="Nombre">
		<br>
		<input type="email" placeholder="Email">
		<br>
		<textarea placeholder="Mensaje"></textarea>
		<br>
		<input type="submit" value="Enviar">
	</form>
</center>
</body>
</html>