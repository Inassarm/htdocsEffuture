<?php
//recibir un dato de la url
$id = $_GET['dato'];

//me conecto

$con = new mysqli("10.10.10.160", "clase", "1234", "lunes15");

$sql = "DELETE from todos WHERE id_tod = '$id'";

$con->query($sql);
header("location:index.php");
?>