<?php

	//recibo lo que me envío por GET. Lo llamé i
	$id = $_GET['i'];

	// me conecto
	include("conexion.php");

	//sql para grabar en cesta
	$sql = "INSERT INTO cesta (id_pro) VALUES ('$id')";

	//ejecuto el sql
	$con->query($sql);

	//envío al index
	header("location:index.php");

?>