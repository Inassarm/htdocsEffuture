<?php
$titulo = isset($_GET['titulo_pro']) ? $_GET['titulo_pro'] : '';

$conexion = new mysqli("10.10.10.160", "clase", "1234", "tienda");

// Consulta SQL
$sql = "SELECT titulo_pro, precio_pro FROM productos WHERE titulo_pro LIKE '%$titulo%'";
$resultado = $conexion->query($sql);

if ($resultado && $resultado->num_rows > 0) {
    
    foreach ($resultado as $fila) {
        $nombre = $fila["titulo_pro"];
        $precio = $fila["precio_pro"];

      
        echo "<div style='cursor:pointer; color:pink; font-weight:bold;' onclick=\"alert('El precio de $nombre es: $precio')\"> $nombre </div>";
        
       
        echo "<p style='cursor:pointer; text-decoration:underline;' onclick='mostrar($precio)'>Ver precio de $nombre mediante función</p><br>";
    }

} else {
    
    echo "No hemos encontrado datos para: <b>" . htmlspecialchars($titulo) . "</b>";
}


echo "
<script>
    function mostrar(elprecio) {
        alert('El precio desde JS es: ' + elprecio);
    }
</script>";
?>