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
		session_start();
		include("menu.php");
		if(isset($_SESSION['persona']))
		{
			//hay session, quiero menú logueado
			pinta_menulog();
		}
		else
		{
			// NO hay session, quiero menu no logueado
			pinta_menunolog();
		}
			
	?>
	<h1>Página de Inicio</h1>
	</center>
</body>
</html>