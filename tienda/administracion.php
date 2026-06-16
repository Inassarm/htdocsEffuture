<?php
    if($_POST)
    {
        // 1. Recogemos los datos del formulario 
        $nom  = $_POST['nombre'];
        $desc = $_POST['descripcion'];
        $prec = $_POST['precio'];
        
        // Incluimos tu conexión de base de datos
        include("conexion.php"); 
        
    
        $nombre_foto = "no-foto.png";

        // 2. Insertamos primero el registro en la tabla 'compras'

        $sql = "INSERT INTO compras (nombre, descripcion, precio, imagen) VALUES ('$nom', '$desc', '$prec', '$nombre_foto')";
        $con->query($sql);
        
        // Recuperamos el 'id_producto' único que se acaba de generar
        $id = $con->insert_id;

        // 3. Si el administrador seleccionó una foto, la procesamos usando el ID
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            
            // Creamos la carpeta del producto si no existe: ./archivos2/ID_PRODUCTO
            if (!file_exists("./archivos2/$id")) {
                mkdir("./archivos2/$id", 0777, true);
            }

            $nombre_foto = $_FILES['foto']['name'];
            
            // Destino final en el servidor
            $ruta_destino = "./archivos2/$id/" . $nombre_foto;

            // Movemos la imagen desde la memoria temporal a su carpeta física
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_destino)) {
                
                // 4. Actualizamos el campo 'imagen' con el nombre del archivo real
                $sql_update = "UPDATE compras SET imagen = '$nombre_foto' WHERE id_producto = $id";
                $con->query($sql_update);
            }
        }

        // Al terminar, redirigimos al catálogo (index.php) para ver el resultado
        header("location: index.php");
        exit(); 
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Registrar en Tabla Compras</title>


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
    </style>
</head>
<body>
<center>
   
    <h2 style= "margin-top: 30px; margin-bottom: 15px;">Añadir Productos </h2>
    <a href="index.php" style="text-decoration: none; color: black;" >Ver productos!</a>

    <br>
    
    <form method="POST" enctype="multipart/form-data" style="background: #f4f4f4; padding: 20px; display: inline-block; border-radius: 8px; margin-top: 20px;">
        
        <label>Nombre del Artículo:</label><br>
        <input type="text" name="nombre" placeholder="Ej: Dorayaki" required size="35">
        <br><br>
        
        <label>Descripción:</label><br>
        <input type="text" name="descripcion" placeholder="Ej: Platillo casero" required size="35">
        <br><br>
        
        <label>Precio:</label><br>
        <input type="number" name="precio" placeholder="0.00" step="0.01" min="0" required style="width: 265px;">
        <br><br>
        
        <label>Fotografía del Producto:</label><br>
        <input type="file" name="foto" accept="image/*" required>
        <br><br><br>
        
        <input type="submit" value="Guardar Producto" style="padding: 8px 20px; font-weight: bold; cursor: pointer;">
    </form>
</center>
</body>
</html>