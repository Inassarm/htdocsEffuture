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
		include("menus.php");
		pinta_menulog();
		//saco la id de la session
		$id = $_SESSION["persona"];
		//buscamos datos
		include("conexion.php");
		$sql = "SELECT * FROM personal WHERE id_per = '$id'";
		$res = $con->query($sql);
		foreach($res as $fil)
		{
			$nom = $fil["nom_per"];
			$ema = $fil["email_per"];
		}
	?>
	<h1>Página de perfil de <?= $nom?></h1>
	<form>
		<input type="text" name="nombre" placeholder="Nombre" value="<?= $nom?>">
		<input type="email" name="email" placeholder="Email" value="<?= $ema?>">
		<input type="submit"value="Actualizar">
	</form>
	</center>
</body>
</html>