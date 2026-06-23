<?php

echo "<font color='red'>Hola</font>";
$colores = array("red", "pink", "orange", "blue", "green", "black");

foreach($colores as $color) {
    echo "<font color='$color'>Hola</font>";
}

echo "<hr>";

$frutas = array("pera", "arándano", "kiwi", "fresa", "mango", "sandía");

for($i=0; $i<6; $i++) {
    echo "<font color='$colores[$i]'>$frutas[$i]</font>";
}

foreach($frutas as $fruta) {
    echo "<p>$fruta</p>";
}
    
$papel = "";
foreach($frutas as $fruta) {
    $papel .= "$fruta, "; // Se van acumulando
}

echo $papel;

echo "<hr>";

for($i; $i<16; $i++){
    echo "<input type='text' name='nombre$i' placeholder='Dato $i'>";
}

// echo "<input type='text' name='dato_1' placeholder='Ingrese el dato 1'><br>";
// echo "<input type='text' name='dato_2' placeholder='Ingrese el dato 2'><br>";
// echo "<input type='text' name='dato_3' placeholder='Ingrese el dato 3'><br>";
// echo "<input type='text' name='dato_4' placeholder='Ingrese el dato 4'><br>";
// echo "<input type='text' name='dato_5' placeholder='Ingrese el dato 5'><br>";
// echo "<input type='text' name='dato_6' placeholder='Ingrese el dato 6'><br>";
// echo "<input type='text' name='dato_7' placeholder='Ingrese el dato 7'><br>";
// echo "<input type='text' name='dato_8' placeholder='Ingrese el dato 8'><br>";
// echo "<input type='text' name='dato_9' placeholder='Ingrese el dato 9'><br>";
// echo "<input type='text' name='dato_10' placeholder='Ingrese el dato 10'><br>";
// echo "<input type='text' name='dato_11' placeholder='Ingrese el dato 11'><br>";
// echo "<input type='text' name='dato_12' placeholder='Ingrese el dato 12'><br>";
// echo "<input type='text' name='dato_13' placeholder='Ingrese el dato 13'><br>";
// echo "<input type='text' name='dato_14' placeholder='Ingrese el dato 14'><br>";
// echo "<input type='text' name='dato_15' placeholder='Ingrese el dato 15'><br>";




?>