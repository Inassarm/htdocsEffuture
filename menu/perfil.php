<?php
// 1. LAS SESIONES Y CONFIGURACIONES VAN AL PRINCIPIO ABSOLUTO
session_start();
include("menus.php");
include("conexion.php");

// Verificamos que el usuario tenga sesión activa
$id = $_SESSION["persona"] ?? null;
if (!$id) {
    die("Error: No has iniciado sesión o la sesión ha expirado.");
}

// 2. PROCESAR SUBIDA DE IMAGEN (Si se envió el formulario de la foto)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['fotico'])) {
    if (!empty($_FILES['fotico']['name'])) {
        $img = $_FILES['fotico']["name"];
        $imgtemp = $_FILES['fotico']["tmp_name"];
        
        // Definimos la ruta de la carpeta del usuario
        $directorio_usuario = "./avatares/$id";

        // Si la carpeta del ID (ej: 55) no existe, la creamos de forma automática
        if (!is_dir($directorio_usuario)) {
            mkdir($directorio_usuario, 0777, true);
        }

        // Insertamos en la base de datos
        $sql = "INSERT INTO avatares (id_per, nom_ava) VALUES ('$id', '$img')";
        $con->query($sql);
        
        // Movemos el archivo a su nueva carpeta vacía o existente
        if (move_uploaded_file($imgtemp, "$directorio_usuario/$img")) {
            echo "<script>alert('¡Avatar subido con éxito!');</script>";
        } else {
            echo "<script>alert('Error al mover el archivo subido.');</script>";
        }
    }
}

// 3. RECUPERAR DATOS DEL USUARIO PARA EL FORMULARIO
$sql = "SELECT * FROM personal WHERE id_per = '$id'";
$res = $con->query($sql);
$nom = "";
$ema = "";

if ($res && $res->num_rows > 0) {
    $fil = $res->fetch_assoc();
    $nom = $fil["nom_per"];
    $ema = $fil["email_per"];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perfil de Usuario</title>
</head>
<body>
    <center>
    <?php pinta_menulog(); ?>

    <h1>Página de perfil de <?= htmlspecialchars($nom) ?></h1>
    
    <form method="POST" action="actualizar_datos.php"> 
        <input type="text" name="nombre" placeholder="Nombre" value="<?= htmlspecialchars($nom) ?>">
        <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($ema) ?>">
        <input type="submit" value="Actualizar">
    </form>

    <hr style="width: 50%; margin: 20px 0;">

    <h1>Subir avatar</h1>
    <form action="perfil.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="fotico" required>
        <br><br>
        <input type="submit" value="Subir Imagen"> 
    </form>
    </center>
</body>
</html>