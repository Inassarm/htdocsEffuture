<?php
	include("conexion.php");
	session_start();
	$id = $_SESSION["persona"];
	if($_POST)
	{

		$nomdir = $_POST["direccion"];
		$sqlgradir = "INSERT INTO direcciones (id_per, dir_dir) VALUES ('$id', '$nomdir')";
		$con->query($sqlgradir);
		header("location:direcciones.php");
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
		pinta_menulog();
		//saco la id de la session
		
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
	<h1>Alta de direcciones de <?= $nom?></h1>
	<form method="POST">
		<input type="text" name="direccion" placeholder="Dirección">
		<input type="submit"value="Registrar dirección">
	</form>

	<?php
		//buscamos direcciones:
		$sqldir = "SELECT * FROM direcciones WHERE id_per = '$id'";
		$resdir = $con->query($sqldir);
		if($resdir->num_rows > 0)
		{
	?>
	<h1>Direcciones</h1>
		<table border=1>
			<thead>
				<tr>
					<th>#</th>
					<th>Dirección</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$numero = 1; 
				foreach($resdir as $fildir)
				{
					$iddid = $fildir["id_dir"]; 
					$dir = $fildir["dir_dir"];
					echo "<tr>
							<td>$numero</td>
							<td>$dir</td>
						<tr>";
					$numero = $numero + 1;		
				}	
				?>
			</tbody>
		</table>
	<?php
		}
	?>

	</center>
</body>
</html>