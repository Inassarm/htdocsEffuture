<?php
// Iniciamos sesión para poder leer los datos guardados
session_start();

// Si por alguna razón la sesión está vacía (no se registró), lo echamos
if (!isset($_SESSION["personal"])) {
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

    <h1>Bienvenido a tu perfil</h1>

    <p><strong>Nombre:</strong> <?php echo $_SESSION["personal"]; ?></p>
    <p><strong>Correo Electrónico:</strong> <?php echo $_SESSION["correo"]; ?></p>

    <br>
    <a href="logout.php">Cerrar Sesión</a>

</body>
</html>