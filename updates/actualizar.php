<?php

//recibir los datos del form
$id = $_POST['laid'];
$nom = $_POST['nombre'];
$ape = $_POST['apellidos'];
$age = $_POST['edad'];

//me conecto

$con = new mysqli("10.10.10.160", "clase", "1234", "lunes15");

$sql = "UPDATE todos SET nom_tod='$nom', ape_tod='$ape', edad_tod='$age' WHERE id_tod='$id'";

//ejecutamos
$con->query($sql);
header("location:index.php");
?>