<?php
    if($_POST)
    {
        // 1. Recogemos los datos del formulario
        $nom = $_POST['nombre'];
        $ape = $_POST['apellidos'];
        $ema = $_POST['correo'];
        $pas = password_hash($_POST['contra'], PASSWORD_DEFAULT);
        
        include("conexion.php");
        
        // 2. Insertamos primero en la tabla de la persona
        $sql = "INSERT INTO personas (nombre, apellidos, email, password) VALUES ('$nom', '$ape', '$ema', '$pas')";
        $con->query($sql);
        
        // Obtenemos el ID de la persona que se acaba de registrar
        $id = $con->insert_id;

        // 3. Procesamos la fotografía si el usuario subió una
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            
            // Creamos la carpeta del usuario si no existe
            if (!file_exists("./avatares/$id")) {
                mkdir("./avatares/$id", 0777, true);
            }

            // Obtenemos el nombre original del archivo subido
            $nombre_foto = $_FILES['foto']['name'];
            
            // Ruta completa donde guardaremos la imagen físicamente
            $ruta_destino = "./avatares/$id/" . $nombre_foto;

            // Movemos el archivo temporal a su carpeta definitiva
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_destino)) {
                
                // 4. Insertamos el registro en la tabla de fotos en singular 'foto'
                $sql_foto = "INSERT INTO foto (nombre, id_per, predeterminado) VALUES ('$nombre_foto', '$id', 1)";
                $con->query($sql_foto);
            }
        }

        header("location:gracias.php");
        exit(); 
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
</head>
<body>
    <center>
    <?php
        include("menu.php");
        pinta_menunolog();
    ?>
    <h1>Registro</h1>
    <span>Rellena el formulario</span>
    
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <br><br>
        
        <input type="text" name="apellidos" placeholder="Apellidos" required>
        <br><br>
        
        <input type="email" name="correo" placeholder="Email" required>
        <br><br>
        
        <input type="password" name="contra" placeholder="Contraseña" required>
        <br><br>
        
        <label>Foto de perfil:</label><br>
        <input type="file" name="foto" accept="image/*" required>
        <br><br>
        
        <input type="submit" value="Registrarse">
    </form>
</center>
</body>
</html>