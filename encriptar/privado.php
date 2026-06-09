<?php
session_start();

// Validamos que existan 
if (!isset($_SESSION["personal"]) || !isset($_SESSION["correo"])) {
    // Si no existen, redirigimos al registro
    header("Location: registro.html");
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil</title>
</head>
<body>

    <h1>¡Bienvenido a tu perfil!</h1>

    <p><strong>Nombre:</strong> <?php echo ($_SESSION["personal"]); ?></p>
    <p><strong>Correo Electrónico:</strong> <?php echo ($_SESSION["correo"]); ?></p>

    <br>
    <a href="logout.php">Cerrar Sesión</a>

</body>
</html>




