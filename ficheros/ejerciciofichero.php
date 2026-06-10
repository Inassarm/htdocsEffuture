<?php

$conexion = mysqli_connect("localhost", "root", "", "lunes_8");

$arc = $_FILES["archivo"]["name"]; 
echo $arc;

$arctemporal = $_FILES["archivo"] ["tmp_name"];
echo "$arctemporal<br>";

move_uploaded_file($arctemporal, "./ficheros$arc");


if ($arc != "") { 
    $sql = "INSERT INTO archivos (nombre) VALUES ('$arc')";
    
    if (mysqli_query($conexion, $sql)) {
        echo "¡Nombre del archivo grabado en la tabla con éxito!";
    } else {
        echo "Error al grabar en la tabla: " . mysqli_error($conexion);
    }
}

// Cerrar la conexión
mysqli_close($conexion);

?>