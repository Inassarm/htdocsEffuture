<?php

    $palabra = "alfonso";

    //texto en mayúsculas
    $palabramayus = strtoupper($palabra);

    echo "$palabra en mayúsculas es $palabramayus <br>";
    echo "voy a escribir en ".$palabramayus."<br>";

    $palabraminus = strtolower($palabramayus);

    echo $palabramayus ." en minusculas " .$palabraminus. "<br>";
    echo "la primera en mayúscula es ". ucfirst($palabra)."<br>";
    echo ucwords("villagarcia")." de " .ucfirst("arousa");

    $producto = " rueda ";
    //eliminar inicio y fin
    $productotrimeado = trim($producto);

?>