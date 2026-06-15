<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Registro</title>
</head>
<body>
    <?php
        // Capturamos el ID que viene por la URL
        $idto = $_GET['identificador'];

        // Nos conectamos y hacemos la consulta
        $con = new mysqli("10.10.10.160", "clase", "1234","lunes15");
        $sql = "select * from todos where id_tod='$idto'";

        $resultado = $con->query($sql);
        $fila = $resultado->fetch_assoc();
        
        // Guardamos los datos en variables
        $nom = $fila["nom_tod"];
        $ape = $fila["ape_tod"];
        $age = $fila["edad_tod"];
    ?>

    <h1>Actualizando a <?="$nom $ape" ?> </h1>
    
    <form action="actualizar.php" method="POST">
        
        <label>Nombre:</label><br>
        <input type="text" name="nombre" placeholder="Nombre" value="<?= $nom ?>">
        <br><br>

        <label>Apellidos:</label><br>
        <input type="text" name="apellidos" placeholder="Apellidos" value="<?= $ape ?>">
        <br><br>
        
        <label>Edad:</label><br>
        <input type="text" name="edad" placeholder="Edad" value="<?= $age ?>">
        <br><br>
        
        <input type="hidden" name="laid" value="<?= $idto ?>">
        
        <input type="submit" value="Guardar Cambios">
    </form>
    
</body>
</html>