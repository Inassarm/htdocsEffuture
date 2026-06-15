<?php
// Conexión a la base de datos
$con = new mysqli("localhost", "root", "", "tienda");

if ($con->connect_error) {
    die("Error de conexión: " . $con->connect_error);
}

$id_usuario_actual = 1; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda - Productos</title>
</head>
<body>
    <h1>Catálogo de Productos</h1>
    
    <a href="carrito.php" style="font-size: 18px; font-weight: bold; color: green;">🛒 Ver mi Cesta</a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
    
            $sql = "SELECT id_producto, nombre, descripcion, precio FROM compras ORDER BY nombre ASC";
            $resultado = $con->query($sql);

            if ($resultado->num_rows > 0) {
                foreach($resultado as $fila) {
                    $id   = $fila["id_producto"];
                    $nom  = $fila["nombre"];
                    $desc = $fila["descripcion"];
                    $pre  = $fila["precio"];
                    
                    echo "
                    <tr>
                        <td>$id</td>
                        <td><strong>$nom</strong></td>
                        <td>$desc</td>
                        <td>$$pre</td>
                        <td>
                            <a href='agregar.php?id_prod=$id'>➕ Añadir a la Cesta</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No hay productos en la tienda.</td></tr>";
            }
            $con->close();
            ?>
        </tbody>
    </table>
</body>
</html>