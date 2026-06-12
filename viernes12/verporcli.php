<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<a href="index.html">Inicio</a>
	<a href="subirporcli.php">Grabar imagen</a>
	<a href="verporcli.php">Ver imágenes de clientes</a>
	<hr>
	<h1>Imágenes de clientes</h1>
	<b>Seleccina un cliente para ver sus imágenes</b>
	<form action="" method="POST">
		<select name="cliente">
			<?php
				include("conexion.php");
				$busclientes = "SELECT DISTINCT id_cli FROM imagenes";
				$resultadobusclientes = $con->query($busclientes);
				foreach($resultadobusclientes as $filaclientes)
				{
					$idcli = $filaclientes["id_cli"];
					echo "<option>$idcli</option>"; 
				} 
			?>
		</select>
		<input type="submit" value="Buscar">
	</form>
	
	<?php
		if($_POST)
		{
			$idseleccionada = $_POST['cliente'];

			$sql = "SELECT id_cli, nom_ima FROM imagenes WHERE id_cli ='$idseleccionada'";
			$resultado = $con->query($sql);
			foreach($resultado as $fila)
			{
				$id = $fila["id_cli"];
				$nombre = $fila["nom_ima"];
				$ruta = "./archivos/";
				if($id != 0)
				{
					$ruta = "./archivos/$id";
				}

				echo "<p><img src='$ruta/$nombre'></p>";
			}
		}	
	?>
	

</body>
</html>