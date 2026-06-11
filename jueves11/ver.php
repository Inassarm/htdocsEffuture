<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="index.html">Inicio</a>
    <a href="subir.php">Grabar Imagen</a>
    <a href="ver.php">Ver imágenes</a>
    <hr>
    <h1>Imágenes</h1>

    <?php

        include("conexion.php");
        $sql = "SELECT nom_ima FROM imagenes";
        $resultado = $con->query($sql);
        foreach($resultado as $fila)
        {
            $nombre = $fila["nom_ima"];
            echo "<p><img src='./archivos/$nombre' width=200 ></p>";

        }


    ?>
    <p>Imagen 1</p>
    <p>Imagen 2</p>

    
</body>
</html>




