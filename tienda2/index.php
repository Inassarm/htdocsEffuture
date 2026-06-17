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
		}

		a:hover
		{
			color: white;
		}

		input, textarea
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

		table
		{
			width: 100%;
		}

		td
		{
			width: 25%;
		}
	</style>
</head>
<body>
	<center>
		<a href="index.php"><i class="fa-solid fa-shop"></i></a>
		<?php
			//me conecto
			include("conexion.php");
			//voy a ver si hay prodcutos en la cesta, sólo por ponerlo ;)
			$sqlcuenta = "SELECT COUNT(id_pro) as cuenta FROM cesta";
			$res = $con->query($sqlcuenta);

			$filacuenta = $res->fetch_assoc();

			$total = $filacuenta["cuenta"];

			if($total > 0)
			{
				echo '<a href="cesta.php"><i class="fa-solid fa-cart-shopping fa-beat" style="color: rgb(99, 230, 190);"></i></a>';
				
			}
			else
			{
				echo '<a href="cesta.php"><i class="fa-solid fa-cart-shopping"></i></a>';
			}
		?>
		
		<!-- enlace para entrar en la parte de alta de productos. Recuerda que está dentro de una carpeta. -->
		<a href="./adm/index.html"><i class="fa-solid fa-lock"></i></a>
		<hr>
		<h1>La tienda del PC</h1>
		<?php
			if($total > 0)
			{
				echo "<h5>Tienes $total productos en la cesta</h5>";
			}
		?>
		<table>
			<!-- vamos a intentar meter 4 productos por fila, cada 4 se tendrá que crear una fila nueva en la tabla -->
			<?php
				$sql = "SELECT * FROM productos";
				$resultado = $con->query($sql);
				$contador = 1;

				foreach($resultado as $fila)
				{
					$idpro = $fila["id_pro"];
					$tit = $fila["titulo_pro"];
					$pre = $fila["precio_pro"];
					$img = $fila["nom_pro"];
					$ruta = "./productos/$idpro/$img";

					if($contador == 1)
					{
						echo "<tr>";
					}

					echo "<td>
						<center>
							<img src='$ruta' width='100%' height='300px'>
							<p>$tit</p>
							<p><font color='lime'>$pre €</font></p>
<button onclick='window.location.href=`anadir.php?i=$idpro`'>
								<i class='fa-solid fa-cart-shopping'></i>
							</button>
						</center>
					</td>";

					$contador = $contador + 1;
					// $contador++;

					if($contador == 5)
					{
						echo "</tr>";
						
						$contador = 1;
					}
				}

			?>
			
		</table>
	</center>	

</body>
</html>