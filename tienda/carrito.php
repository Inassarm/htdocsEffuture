<?php
// Conectamos a la base de datos
$con = new mysqli("localhost", "root", "", "tienda");

if ($con->connect_error) {
    die("Error de conexión: " . $con->connect_error);
}

// BORRAR UN PRODUCTO
if (isset($_GET['eliminar_id'])) {
    $id_borrar = $_GET['eliminar_id'];
    $con->query("DELETE FROM cesta WHERE id_cesta = $id_borrar");
    header("Location: carrito.php");
    exit();
}


// AÑADIR O INCREMENTAR UN PRODUCTO 
if (isset($_GET['id_prod'])) {
    $id_producto = $_GET['id_prod'];
    
    $consulta = "SELECT id_cesta, cantidad FROM cesta WHERE id_producto = $id_producto";
    $resultado_busqueda = $con->query($consulta);
    
    if ($resultado_busqueda->num_rows > 0) {
        $fila = $resultado_busqueda->fetch_assoc();
        $nueva_cantidad = $fila['cantidad'] + 1;
        $id_cesta = $fila['id_cesta'];
        $con->query("UPDATE cesta SET cantidad = $nueva_cantidad WHERE id_cesta = $id_cesta");
    } else {
        $con->query("INSERT INTO cesta (id_producto, cantidad) VALUES ($id_producto, 1)");
    }
    header("Location: carrito.php");
    exit();
}

//ACTUALIZAR CANTIDAD DESDE EL CARRITO

if (isset($_GET['id_cesta']) && isset($_GET['accion'])) {
    $id_cesta = $_GET['id_cesta'];
    $accion = $_GET['accion'];

    // Primero consultamos cuántos productos hay actualmente en esa fila
    $consulta_cant = $con->query("SELECT cantidad FROM cesta WHERE id_cesta = $id_cesta");
    $fila_cant = $consulta_cant->fetch_assoc();
    $cantidad_actual = $fila_cant['cantidad'];

    if ($accion == 'sumar') {
        $nueva_cantidad = $cantidad_actual + 1;
        $con->query("UPDATE cesta SET cantidad = $nueva_cantidad WHERE id_cesta = $id_cesta");
    } 
    
    if ($accion == 'restar') {
        $nueva_cantidad = $cantidad_actual - 1;
        
        // Si la cantidad baja de 1, lo borramos automáticamente de la cesta
        if ($nueva_cantidad < 1) {
            $con->query("DELETE FROM cesta WHERE id_cesta = $id_cesta");
        } else {
            $con->query("UPDATE cesta SET cantidad = $nueva_cantidad WHERE id_cesta = $id_cesta");
        }
    }

    header("Location: carrito.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Cesta</title>
<style>
    :root {
            --primary-color: #2ecc71;
            --primary-hover: #27ae60;
            --dark-color: #2c3e50;
            --light-bg: #f8f9fa;
            --text-color: #333;
            --shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--light-bg);
            color: var(--text-color);
            padding: 40px 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            flex-wrap: wrap;
            gap: 20px;
        }

        h1 {
            color: var(--dark-color);
            font-weight: 700;
            font-size: 2.5rem;
            position: relative;
        }

        h1::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: var(--primary-color);
            margin-top: 8px;
            border-radius: 2px;
        }

        .nav-buttons {
            display: flex;
            gap: 15px;
        }

        .btn {
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .btn-cart {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-cart:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }

        .btn-admin {
            background-color: transparent;
            color: var(--dark-color);
            border: 2px solid var(--dark-color);
        }

        .btn-admin:hover {
            background-color: var(--dark-color);
            color: white;
            transform: translateY(-2px);
        }

        /* Grid de Productos estilo Tarjetas */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 20px;
        }

        .product-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .product-image-wrapper {
            position: relative;
            width: 100%;
            padding-top: 100px; /* Relación de aspecto 1:1 (Cuadrado) */
            background-color: #eee;
            overflow: hidden;
        }

        .product-card img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .product-name {
            font-size: 1.25rem;
            color: var(--dark-color);
            margin-bottom: 10px;
            font-weight: 600;
        }

        .product-desc {
            font-size: 0.9rem;
            color: #7f8c8d;
            margin-bottom: 20px;
            line-height: 1.5;
            flex-grow: 1;
        }

        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }

        .product-price {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--dark-color);
        }

        .btn-add {
            background-color: var(--primary-color);
            color: white;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            transition: background 0.2s ease;
        }

        .btn-add:hover {
            background-color: var(--primary-hover);
        }

        .no-products {
            grid-column: 1 / -1;
            text-align: center;
            padding: 50px;
            background: white;
            border-radius: 12px;
            color: #7f8c8d;
            font-size: 1.2rem;
            box-shadow: var(--shadow);
        }

    </style>
</head>
<body>

    <h1>🛒 Tu Cesta de Compras</h1>
    <a href="index.php">⬅️ Volver al catálogo</a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // 3. LÓGICA PARA MOSTRAR LOS PRODUCTOS
            $sql = "SELECT c.id_cesta, p.nombre, p.precio, c.cantidad 
                    FROM cesta c 
                    INNER JOIN compras p ON c.id_producto = p.id_producto";
            
            $resultado_tabla = $con->query($sql);
            $total_general = 0;

            while ($fila = $resultado_tabla->fetch_assoc()) {
                $nombre_prod = $fila['nombre'];
                $precio_prod = $fila['precio'];
                $cantidad_prod = $fila['cantidad'];
                $id_cesta_prod = $fila['id_cesta'];
                
                $subtotal = $precio_prod * $cantidad_prod;
                $total_general = $total_general + $subtotal;
                
                echo "<tr>";
                echo "<td>" . $nombre_prod . "</td>";
                echo "<td>$" . $precio_prod . "</td>";
                echo "<td align='center'>";
                echo "<a href='carrito.php?id_cesta=" . $id_cesta_prod . "&accion=restar' style='text-decoration:none; font-weight:bold; color:black;'> ➖ </a>";
                echo " <strong>" . $cantidad_prod . "</strong> ";
                echo "<a href='carrito.php?id_cesta=" . $id_cesta_prod . "&accion=sumar' style='text-decoration:none; font-weight:bold; color:black;'> ➕ </a>";
                echo "</td>";
                
                echo "<td>$" . $subtotal . "</td>";
                echo "<td><a href='carrito.php?eliminar_id=" . $id_cesta_prod . "' style='color:red;'>❌ Eliminar</a></td>";
                echo "</tr>";
            }
            ?>
            
            <tr>
                <td colspan="3" align="right"><strong>Total:</strong></td>
                <td colspan="2"><strong>$<?php echo $total_general; ?></strong></td>
            </tr>
        </tbody>
    </table>

</body>
</html>