<?php
//ARRAYS

$casa = array("cocina", "salón", "habitación", "baños", "trastero");

print_r ($casa);

echo $casa[3];

foreach ($casa as $piso) {
    echo ($piso) . "<br>"; 
}

echo "<br>";

for ($i = count($casa) - 1; $i >= 0; $i--) {
    echo($casa[$i]) . "<br>";
}

?>