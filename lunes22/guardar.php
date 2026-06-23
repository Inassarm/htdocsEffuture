<?php
$con = new mysqli("10.10.10.160", "clase", "1234", "tienda");

if ($con->connect_error) {
    die("Error de conexión: " . $con->connect_error);
}

$sql = "SELECT * FROM butacas"; 
$res = $con->query($sql);

foreach($res as $fila) {
    $id = $fila["id_but"];
    $num = $fila["num_but"];
    $dis = $fila["disponible_but"];
    
    if($dis == 0) { // Libre

        echo "<i class='fa fa-couch' style='color:green; margin: 4px;'>$num</i>";
    } else { // Ocupado
   
        echo "<i class='fa fa-couch' style='color:red; margin: 4px;'>$num</i>";
    }
}
?>