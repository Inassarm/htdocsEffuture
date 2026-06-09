<?php
session_start();

if (!isset($_SESSION["personal"])) {
    header("Location: entrar.html");
    exit(); 
}

$correo_usuario = $_SESSION["correo"];

$conexion = new mysqli("10.10.10.160", "clase", "1234", "martes9");

// Buscamos la dirección uniendo las dos tablas con INNER JOIN
$sql = "SELECT d.dir_dir FROM personal p 
        INNER JOIN direcciones d ON p.id_per = d.id_per 
        WHERE p.email_per = '$correo_usuario'";

$resultado = $conexion->query($sql);

$direccion = "No registrada";

// Si el usuario tiene dirección guardada, la saca con el foreach
if ($resultado->num_rows > 0) {
    foreach ($resultado as $fila) {
        $direccion = $fila["dir_dir"];
    }
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil</title>
</head>
<body>

    <h1>¡Bienvenido a tu perfil!</h1>

    <p><strong>Nombre:</strong> <?php echo $_SESSION["personal"]; ?></p>
    <p><strong>Correo Electrónico:</strong> <?php echo $_SESSION["correo"]; ?></p>
    
    <p><strong>Dirección:</strong> <?php echo $direccion; ?></p>

    <br>
    <a href="direcciones.php">Editar / Registrar Dirección</a>
    <br><br>
    <a href="logout.php">Cerrar Sesión</a>

</body>
</html>