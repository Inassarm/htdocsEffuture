<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Imágenes</title>
</head>
<body>
    <a href="index.html">Inicio</a>
    <a href="subir.php">Grabar Imagen</a>
    <a href="ver.php">Ver imágenes</a>
    <hr>
    <h1>Imágenes</h1>

    <?php
        include("conexion.php");
        
        $sql = "SELECT id_cli, nom_ima FROM imagenes WHERE id_cli <> '0'";
        $resultado = $con->query($sql);
        
        foreach($resultado as $fila)
        {
            $id = $fila["id_cli"];
            $nombre = $fila["nom_ima"];
            
            // Dibujamos la imagen con la ruta correcta
            echo "<p><img src='./archivos/$id/$nombre' width='200'></p>";
        }
    ?>
    
</body>
</html>