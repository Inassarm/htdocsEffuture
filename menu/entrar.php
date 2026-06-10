<?php
	if($_POST)
	{
		$ema = $_POST['correo'];
		$pas = $_POST['contra'];
		include("conexion.php");
		$sql = "SELECT * FROM personal WHERE email_per = '$ema'";
		$res = $con->query($sql);
		if($res->num_rows != 0 )
		{
			//encontré email
			foreach($res as $fil)
			{
				$id = $fil["id_per"];
				$pasbd = $fil["pass_per"];
				if(password_verify($pas, $pasbd))
				{
					//coinciden
					session_start();
					$_SESSION['persona'] = $id;
					header("location:index.php");
				}
				else
				{
					echo "Error en datos 1";
				}
			}
		}
		else
		{
			echo "Error en datos 0";
		}
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
	<h1>Login</h1>
	<span>Introduce tus datos</span>
	<form method="POST">
		<input type="email" name="correo" placeholder="Email" required>
		<br>
		<input type="password" name="contra" placeholder="Contraseña" required>
		<br>
		<input type="submit" value="Entrar">
	</form>
</center>
</body>
</html>