<?php
	if($_POST)
	{
		$nom = $_POST['nombre'];
		$ema = $_POST['correo'];
		$pas = password_hash($_POST['contra'], PASSWORD_DEFAULT);
		include("conexion.php");
		$sql = "INSERT INTO personal (nom_per, email_per, pass_per) VALUES ('$nom', '$ema', '$pas')";
		$con->query($sql);
		header("location:gracias.php");
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
	<center>
	<?php
		include("menus.php");
		pinta_menunolog();
	?>
	<h1>Registro</h1>
	<span>Rellena el formulario</span>
	<form method="POST">
		<input type="text" name="nombre" placeholder="Nombre" required>
		<br>
		<input type="email" name="correo" placeholder="Email" required>
		<br>
		<input type="password" name="contra" placeholder="Contraseña" required>
		<br>
		<input type="submit" value="Registrarse">
	</form>
</center>
</body>
</html>