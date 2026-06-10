<?php

$arc = $_FILES["archivo"]["name"]; //el fichero y el nombre
echo $arc;

$arctemporal = $_FILES["archivo"] ["tmp_name"];

echo "$arctemporal<br>";
move_uploaded_file($arctemporal, "./ficheros/$arc");


?>


