<?php
session_start();
include("menu.php");
include("conexion.php");

// 1. CONTROL DE SEGURIDAD
$id = $_SESSION["persona"] ?? die("Error: Inicia sesión primero.");

// 2. SI EL USUARIO SUBE VARIAS FOTOS
if (isset($_POST['btn_foto']) && !empty($_FILES['fotico']['name'][0])) {
    $carpeta = "./avatares/$id";

    // Crear la carpeta del usuario si no existe
    if (!is_dir($carpeta)) mkdir($carpeta, 0777, true);

    // Desmarcar fotos anteriores como predeterminadas
    $con->query("UPDATE foto SET predeterminado = 0 WHERE id_per = '$id'");

    // Recorrer el array de las múltiples fotos usando la nueva sintaxis
    foreach ($_FILES['fotico']['name'] as $indice => $nombre_foto) {
        if ($_FILES['fotico']['error'][$indice] === 0) {
            $tmp_name = $_FILES['fotico']['tmp_name'][$indice];
            
            // La primera foto de la lista será la predeterminada (1), las demás no (0)
            $predeterminado = ($indice === 0) ? 1 : 0;

            // Guardar cada foto en la base de datos
            $con->query("INSERT INTO foto (nombre, id_per, predeterminado) VALUES ('$nombre_foto', '$id', $predeterminado)");
            
            // Mover el archivo real a la carpeta
            move_uploaded_file($tmp_name, "$carpeta/$nombre_foto");
        }
    }
    
    header("Location: perfil.php"); 
    exit();
}

// 3. TRAER DATOS DE LA BASE DE DATOS
$usuario = $con->query("SELECT * FROM personas WHERE id_per = '$id'")->fetch_assoc();
$foto    = $con->query("SELECT * FROM foto WHERE id_per = '$id' AND predeterminado = 1")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Mi Perfil</title>
</head>
<body style="text-align: center; font-family: sans-serif;">

    <?php pinta_menulog(); ?>

    <h1>Perfil de <?= $usuario['nombre'] ?></h1>
    
    <?php if (!empty($foto['nombre'])): ?>
        <img src="./avatares/<?= $id ?>/<?= $foto['nombre'] ?>" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;">
    <?php endif; ?>
    
    <form method="POST" action="actualizar_datos.php" style="margin-top: 20px;"> 
        <input type="text" name="nombre" value="<?= $usuario['nombre'] ?>" placeholder="Nombre"><br><br>
        <input type="text" name="apellidos" value="<?= $usuario['apellidos'] ?>" placeholder="Apellidos"><br><br>
        <input type="email" name="email" value="<?= $usuario['email'] ?>" placeholder="Correo"><br><br>
        <input type="submit" value="Actualizar Datos Personales">
    </form>

    <hr style="width: 50%;">

    <h3>Subir Múltiples Fotos</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="fotico[]" accept="image/*" multiple required><br><br>
        <input type="submit" name="btn_foto" value="Subir Fotos Seleccionadas"> 
    </form>

</body>
</html>