<?php

//recogemos los datos que vienen por post

$bus = $_POST['cosabuscada'];
$con = new mysqli("10.10.10.160", "clase", "1234", "tienda");

$sql = "SELECT * FROM productos WHERE titulo_pro LIKE '%$bus%'";

//guardando el resultado
$resultado = $con -> query($sql);

//recorrer
foreach($resultado as $fila)
    {
        $tit = $fila["titulo_pro"];

        echo "<p>$tit</p>";
    }

?>