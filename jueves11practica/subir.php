<?php

if($_FILES){

    //cuando gestionamos files necesitamos recoger dos cosas, el name y el tmp_name
    $nombreimg = $_FILES["lafoto"]["name"];
    $imgtemp = $_FILES["lafoto"]["tmp_name"];

    //vamos a generar un id único 

    $id = uniqid();

    mkdir("./archivos2/$id",0777);

    //mover la foto

    move_uploaded_file($imgtemp, "./archivos2/$id/$nombreimg");

    //vamos a grabar en la tabla el nombre de la img
    include("conexion.php");
    $grabar = "INSERT INTO imagenes (id_cli, nom_ima) VALUES ('$id','$nombreimg')";

    //ejecutar
    $con -> query($grabar);
    echo "grabado";


}

?>


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
    <h1>subida de imágenes</h1>

    <form action="" method="POST" enctype="multipart/form-data"> //para que el fichero se suba
        <input type="file" name="lafoto">
        <br>
        <input type="submit" value="Subir">
    </form>
    
</body>
</html>